@extends('dashboard.parent')

@section('title','Index Contact')

@section('main-title',' Index Contact')

@section('sub-title',' index contact')

@section('styles')

@endsection

@section('contat')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">List Data of contact</h3>
    </div>

    <!-- /.card-header -->

    <div class="card-body p-3">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">ID</th>
            <th>Name of contact</th>
            <th>mobile</th>
            <th>email</th>
            <th>message</th>


            <th style="width: 40px">Setting</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact )
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->mobile}}</td>
                <td>{{ $contact->email}}</td>
                <td>{{ $contact->message}}</td>

                <td> <div class="btn-group">
                    <a href="{{ route('contacts.edit' , $contact->id) }}" type="button" class="btn btn-info">
                      <i class="far  fa-edit"></i>
                    </a>
                    <button type="button" onclick="performDestroy ({{ $contact->id }}  ,this )" class="btn btn-danger">
                      <i class="fas fa-trash"></i>
                    </button>
                    <button type="button" class="btn btn-success">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>

                  </a></td>


            @endforeach


        </tbody>
      </table>
      {{ $contacts->links() }}
    </div>
    <!-- /.card-body -->
  </div>

@endsection

@section('script')

<script>
    function performDestroy(id ,referance){
        confirmDestroy('/dash/admin/contacts/' + id ,referance)
    }
    </script>
@endsection
