<div class="pageheader">
<h2><i class="fa {{ $icon or '' }}"></i> {{ end($items) }} <span>{{ $description }}</span></h2>
  <div class="breadcrumb-wrapper">
    <span class="label">当前位置:</span>
    <ol class="breadcrumb">
      @foreach ($items as $item) 
      <li class="active">{{ $item }}</li>
      @endforeach
    </ol>
  </div>
</div>
