<button class="btn btn-sm btn-outline-info" title="Edit" onclick="edit({{ $id }})">
    <i class="fa fa-edit"></i>
 </button>
 
 <button class="btn btn-sm btn-outline-danger" onclick="destroy('{{ route('authorization.permission.destroy', $id) }}', '#table', true)">
     <i class="fa fa-trash"></i>
  </button>
  