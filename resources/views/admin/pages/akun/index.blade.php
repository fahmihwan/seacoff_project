@extends('admin.layouts.main')


@section('container')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Pengaturan Akun</h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
                <div class="p-2 bd-highlight">
                    <a href="/admin/setting/akun/registerasi" class="btn btn-primary">Tambah Akun</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-3">
        <div class="bg-white p-3" style="width:600px;">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nama</th>
                        <th scope="col">username</th>
                        <th scope="col">hak akses</th>
                        <th scope="col">Hapus Akun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->hak_akses }}</td>
                            <td>
                                {{-- @if ($user->hak_akses == 'admin') --}}
                                {{-- <form action="">
                                    <button class="btn btn-secondary btn-sm" disabled>Delete</button>
                                </form> --}}
                                {{-- @endif --}}
                                {{-- @if ($user->hak_akses == 'user') --}}
                                <form action="/admin/setting/akun/{{ $user->id }}/destroy" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                {{-- @endif --}}

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
@endsection
