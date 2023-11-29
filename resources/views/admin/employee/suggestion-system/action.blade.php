<button class="btn btn-sm btn-outline-info" title="Edit" onclick="edit({{ $id }})" title="Edit">
    <i class="fa fa-edit"></i>
 </button>
 
 <button class="btn btn-sm btn-outline-danger" onclick="destroy('{{ route('employee.suggestion-system.destroy', $id) }}', '#table', true)" title="Hapus">
     <i class="fa fa-trash"></i>
  </button>

  @can('evaluasi suggestion system')
      <button class="btn btn-sm btn-outline-success" onclick="evaluasi({{ $id }})" title="Evalusi">
          <i class="fa fa-check"></i>
      </button>
  @endcan
  