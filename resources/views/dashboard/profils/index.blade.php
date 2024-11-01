@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Profile</h1>
</div>

@if (session()->has('message'))
  <div class="alert alert-{{ session('alert-type') }} col-lg-50" role="alert" id="alert-message">
    {{ session('message') }}
  </div>
@endif

<div class="table-responsive col-lg-10 mb-5">
  <a href="/dashboard/profils/create" class="btn btn-primary mb-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Create">Create Profile</a> 
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Copyright</th>
          <th scope="col">Made With</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($profile as $profil)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $profil->name }}</td>
            <td>{{ $profil->link }}</td>
            <td>{{ $profil->content }}</td>
            <td>
              <a href="/dashboard/profils/{{ ($profil->id) }}/edit" class="badge bg-warning text-decoration-none d-inline" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span data-feather="edit"></span></a>
              <form action="/dashboard/profils/{{ $profil->id }}" method="post" class="d-inline delete-form">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="confirmDelete(this, '{{ $profil->name }}')"><span data-feather="x-circle"></span></button>
              </form>
            </td>
          </tr>    
          @endforeach
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alert = document.getElementById('alert-message');
        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 4000); // 4000ms = 4 seconds
        }
    });

    function confirmDelete(button, profileName) {
        Swal.fire({
            title: "Hapus " + profileName + " ?",
            text: "Yakin mau hapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>
@endsection