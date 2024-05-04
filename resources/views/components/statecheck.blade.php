@if ($state=="opened")
<span class="badge rounded-pill text-primary">Opened</span>

@elseif ($state=="approved")
<span class="badge rounded-pill text-success">Approved</span>

@elseif ($state=="reject")
<span class="badge rounded-pill text-danger">Rejected</span>

@else
<span class="badge rounded-pill text-warning">Pending</span>

@endif