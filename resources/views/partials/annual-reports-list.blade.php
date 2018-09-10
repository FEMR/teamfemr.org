@foreach($annual_reports as $report)
<a href="{{ Storage::url($report->file_name) }}" target="_blank">
    <span>{{ $report->title }}</span>
    <span class="icon is-small has-text-info">
      <i class="fa fa-external-link"></i>
    </span>
</a>
@endforeach