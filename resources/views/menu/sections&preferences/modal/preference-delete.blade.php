<div class="modal fade" id="delete-preference-{{$menu_preference->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Preference</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <p>Preference Name</p>
            <h5 class="mt-3 text-break">{{$menu_preference->name}}</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="{{route('menu.section.destroy',['id' => $menu_preference->id, 'type' => 'preference'])}}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </form>
        </div>
    </div>
</div>