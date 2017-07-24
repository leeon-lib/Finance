<?php

namespace App\Providers\Modules;

class ServiceException extends \Exception  {}

class Service
{
    protected $force = false;

    public function call($function, $parameters = array())
    {/*{{{*/
        $parameters = is_array($parameters)? $parameters: array($parameters);

        if ($this->invalidFunction($function))
        {
            throw new ServiceException('无效的方法: "'.$function.'"');
        }

        return $this->run($function, $parameters);
    }/*}}}*/

    public function ignoreCache($force)
    {/*{{{*/
         $this->force = !!$force;
    }/*}}}*/

    public function cache($function, $parameters = array(), $minute = 1, $force='whatever')
    {/*{{{*/
        $parameters = is_array($parameters)? $parameters: array($parameters);

        $key = $this->makeKey($function, $parameters);

        $res = array();
        if ($force !== 'force' && ! $this->force)
        {
            $res = DRedis::get($key);
        }

        if (is_empty($res))
        {
            $res = $this->call($function, $parameters);
            DRedis::put($key, $res, $minute);
        }
        return $res;
    }/*}}}*/

    public function async($function, $parameters = array(), $retry = 0) { }
    public function monopolize($function, $parameters = array(), $wait) { }
    public function must($function, $parameters = array()) { }

    public function makeKey($function, $parameters)
    {/*{{{*/
         return md5(strtolower($function.serialize($parameters)));
    }/*}}}*/

    private function invalidFunction($function)
    {/*{{{*/
        list($service, $method) = $this->parseFunction($function);
        return is_empty($service) || is_empty($method);
    }/*}}}*/

    private function parseFunction($function)
    {/*{{{*/
        $parsed = explode('@', $function);
        if (count($parsed) > 1)
        {
            $parsed[0] .= 'Service';
        }
        return $parsed;
    }/*}}}*/
    
    private $routes = array();

    public function answer($function, $handle)
    {/*{{{*/
        if (is_empty($function) || is_empty($handle)) return;
         
        $this->addRoute($function, $handle);
    }/*}}}*/

    private function addRoute($function, $handle)
    {/*{{{*/
        if ($this->invalidFunction($function) || is_empty($handle))
        {
            return;
        }

        if (! $handle instanceof Closure && $this->invalidFunction($handle))
        {
            throw new ServiceException('无效的handle: "'.$handle.'"');
        }

        $this->routes[$function] = $handle;
    }/*}}}*/

    private function run($function, $parameters = array())
    {/*{{{*/
        if (isset($this->routes[$function]))
        {
            $handle = $this->routes[$function];
            if (is_string($handle))
            {
                list($service, $method) = $this->parseFunction($handle);
                return call_user_func_array(array(new $service, $method), $parameters);
            }
            elseif ($handle instanceof Closure)
            {
                return call_user_func_array($handle, $parameters);
            }
        } else {
            list($service, $method) = $this->parseFunction($function);
            return call_user_func_array(array(new $service, $method), $parameters);
        }
    }/*}}}*/
}
