<button class="btn btn-sm btn-outline-info" title="Edit" onclick="edit({{ $item->id }})">
    <i class="fa fa-edit"></i>
 </button>
 
 <button class="btn btn-sm btn-outline-danger" onclick="destroy({{ $item->id }})">
     <i class="fa fa-trash"></i>
  </button>
  