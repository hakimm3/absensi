<button class="btn btn-sm btn-outline-info" title="Edit" onclick="edit({{ $id }})">
    <i class="fa fa-edit"></i>
 </button>
 
 <button class="btn btn-sm btn-outline-danger" onclick="destroy('{{ route('authorization.role.destroy', $id) }}', '#table', true)">
     <i class="fa fa-trash"></i>
  </button>
  
  <a class="btn btn-sm btn-outline-warning" href="{{ route('authorization.role.show', Crypt::encrypt($id)) }}">
    <i class="fas fa-cog"></i> Permissions
  </a>