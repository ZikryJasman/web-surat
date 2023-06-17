@extends('desa/layout/app')

@section('title','Data User Pengurus')

@section('content')

<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table Pengurus
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#default">
                Tambah Data
            </button>
        </div>
        <div class="card-body" style="overflow-x:scroll;">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama User</th>
                        <th>Email User</th>
                        <th>Nim</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $pgn)
                    @if($pgn->level=="Staff" OR $pgn->level=="Kepala Desa")
                    <tr>
                        <th><?=$no; ?>. </th>
                        <td>
                            @if($pgn->name==NULL)
                            <span class="text text-danger">Tambahkan Nama?</span>
                            @endif
                            @if($pgn->name!==NULL)
                            {{$pgn->name}}
                            @endif
                        </td>
                        <td>{{$pgn->email}}</td>
                        <td>{{$pgn->nim}}</td>
                        <td>
                            @if($pgn->level=="Pengaju")
                            <span class="badge bg-primary">{{$pgn->level}}</span>
                            @else
                            <span class="badge bg-success">{{$pgn->level}}</span>
                            @endif
                        </td>
                        <td align="center">
                            <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                            <a href="{{route('cek_user',['title'=>Auth::user()->title_user,'id'=>$pgn->id])}}" class="btn btn-sm btn-success rounded-pill"><i class="icon dripicons-preview"></i></a>
                        </td>
                    </tr>
                    @endif
                    <?php $no++ ?>
                    <!-- Edit Data -->
                    <!-- End Edit Data -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@include('desa/user/tambah')
@endsection
