@extends('admin.layout.master')
@section('title', 'Site Settings')
@section('content')
    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="tile" style="    border-top: 3px solid #009688;border-radius: 13px 13px 0px 0px;">
                    <div class="tile-body">
                        <div style="display:flex; justify-content:space-between;margin-bottom:20px">
                            <div>Database Backup</div>
                            <a href="#" class="btn btn-primary" id="create-backup"><i class="fa fa-save"></i>Create Backup</a>
                        </div>

                        <table class="table">
                            <tr>
                                <td>ID</td>
                                <td>File</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                            @if($data->count() == 0)
                               <tr>
                                <td colspan="4"> No Data</td>
                               </tr>
                            @else
                               @foreach($data as $dt)
                               <tr>
                                  <td>{{ $dt->id }}</td>
                                  <td>{{ $dt->file }}</td>
                                  <td>{{ $dt->created_at }}</td>
                                  <td>
                                    <a href="/uploads/db_backup/{{ $dt->file}}" class="btn btn-primary">Download</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                  </td>
                               </tr>
                               @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$('#create-backup').click(function(e){
    e.preventDefault();
    var cnf = confirm("Do you want to create backup now.");
    if(cnf){
        $(this).addClass('disabled')
        $(this).css('cursor','wait')
        $.ajax({
        url: "{{ route('site.create_db_backup') }}",
        type: 'post',
        success: function(res){
            $(this).removeClass('disabled')
            $(this).css('cursor','pointer')
            window.location.href = window.location.href
        },
        error: function(err){
            $(this).removeClass('disabled')
            $(this).css('cursor','pointer')
            alert("something went wrong");
        }
    })
    }
})
</script>
@endsection
