@if ($state=="opened")
<span class="badge rounded-pill bg-primary">Opened</span>

@elseif ($state=="approved")
<span class="badge rounded-pill bg-success">Approved</span>

@elseif ($state=="reject")
<span class="badge rounded-pill bg-danger">Rejected</span>

@else
<span class="badge rounded-pill bg-warning">Pending</span>

@endif