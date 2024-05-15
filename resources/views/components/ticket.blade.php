@if ($state=="opened")
<span class="badge rounded-pill bg-primary fs-2">Opened</span>

@elseif ($state=="approved")
<span class="badge rounded-pill bg-success fs-2">Approved</span>

@elseif ($state=="reject")
<span class="badge rounded-pill bg-danger fs-2">Rejected</span>

@else
<span class="badge rounded-pill bg-warning fs-2">Pending</span>

@endif