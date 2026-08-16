@extends('admin/layouts/app')

@section('admin-title', 'Menu Items – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage website navigation menu and menu items')
@section('admin-keywords', 'menu, navigation, items, admin, management')

@section('main')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menu Manager</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menu Manager</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (Session::has('success'))
                <div id="session-alert" class="alert alert-success alert-dismissible fade show">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header"><h3 class="card-title">Add Menu Item</h3></div>
                        <div class="card-body">
                            <form action="{{ route('menu-items.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="e.g. About Us" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>URL / Slug</label>
                                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                                        placeholder="e.g. about/about-d-bels" value="{{ old('url') }}">
                                    <small class="text-muted">Leave blank for parent items with only dropdown children.</small>
                                    @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>Parent Item</label>
                                    <select name="parent_id" class="form-control form-select">
                                        <option value="">� None (top-level) �</option>
                                        @foreach ($all_items as $item)
                                            @if (!$item->parent_id)
                                                <option value="{{ $item->id }}" {{ old('parent_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                @foreach ($item->children as $child)
                                                    <option value="{{ $child->id }}" {{ old('parent_id') == $child->id ? 'selected' : '' }}>
                                                        &nbsp;&nbsp;&nbsp;? {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-select" required>
                                        <option value="active" {{ old('status','active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-1"></i> Add to Menu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Menu Structure</h3>
                            <button id="save-order-btn" class="btn btn-success btn-sm">
                                <i class="fas fa-save me-1"></i> Save Order
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($menu_items->isEmpty())
                                <p class="text-muted text-center py-4">No menu items yet. Add one on the left.</p>
                            @else
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Drag items to reorder. Drag into a sub-list to nest. Click <strong>Save Order</strong> to apply.
                                </p>
                                <ul id="menu-sortable" class="menu-builder-list">
                                    @foreach ($menu_items as $item)
                                        <li class="menu-builder-item" data-id="{{ $item->id }}" data-parent="">
                                            <div class="menu-builder-handle">
                                                <i class="fas fa-grip-vertical drag-icon"></i>
                                                <span class="menu-builder-name">{{ $item->name }}</span>
                                                @if($item->url)
                                                    <span class="menu-builder-url text-muted">� {{ $item->url }}</span>
                                                @endif
                                                <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-secondary' }} ms-2">{{ $item->status }}</span>
                                                <div class="menu-builder-actions ms-auto">
                                                    <button class="btn btn-xs btn-outline-primary btn-edit"
                                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                        data-url="{{ $item->url }}" data-parent_id="{{ $item->parent_id }}"
                                                        data-status="{{ $item->status }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <form action="{{ route('menu-items.destroy', $item) }}" method="POST" class="d-inline delete-form">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            @if ($item->children->isNotEmpty())
                                                <ul class="menu-builder-sublist">
                                                    @foreach ($item->children->sortBy('display_order') as $child)
                                                        <li class="menu-builder-item" data-id="{{ $child->id }}" data-parent="{{ $item->id }}">
                                                            <div class="menu-builder-handle">
                                                                <i class="fas fa-grip-vertical drag-icon"></i>
                                                                <span class="menu-builder-name">{{ $child->name }}</span>
                                                                @if($child->url)<span class="menu-builder-url text-muted">� {{ $child->url }}</span>@endif
                                                                <span class="badge {{ $child->status === 'active' ? 'bg-success' : 'bg-secondary' }} ms-2">{{ $child->status }}</span>
                                                                <div class="menu-builder-actions ms-auto">
                                                                    <button class="btn btn-xs btn-outline-primary btn-edit"
                                                                        data-id="{{ $child->id }}" data-name="{{ $child->name }}"
                                                                        data-url="{{ $child->url }}" data-parent_id="{{ $child->parent_id }}"
                                                                        data-status="{{ $child->status }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </button>
                                                                    <form action="{{ route('menu-items.destroy', $child) }}" method="POST" class="d-inline delete-form">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit" class="btn btn-xs btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @if ($child->children->isNotEmpty())
                                                                <ul class="menu-builder-sublist">
                                                                    @foreach ($child->children->sortBy('display_order') as $grandchild)
                                                                        <li class="menu-builder-item" data-id="{{ $grandchild->id }}" data-parent="{{ $child->id }}">
                                                                            <div class="menu-builder-handle">
                                                                                <i class="fas fa-grip-vertical drag-icon"></i>
                                                                                <span class="menu-builder-name">{{ $grandchild->name }}</span>
                                                                                @if($grandchild->url)<span class="menu-builder-url text-muted">� {{ $grandchild->url }}</span>@endif
                                                                                <span class="badge {{ $grandchild->status === 'active' ? 'bg-success' : 'bg-secondary' }} ms-2">{{ $grandchild->status }}</span>
                                                                                <div class="menu-builder-actions ms-auto">
                                                                                    <button class="btn btn-xs btn-outline-primary btn-edit"
                                                                                        data-id="{{ $grandchild->id }}" data-name="{{ $grandchild->name }}"
                                                                                        data-url="{{ $grandchild->url }}" data-parent_id="{{ $grandchild->parent_id }}"
                                                                                        data-status="{{ $grandchild->status }}">
                                                                                        <i class="fas fa-pencil-alt"></i>
                                                                                    </button>
                                                                                    <form action="{{ route('menu-items.destroy', $grandchild) }}" method="POST" class="d-inline delete-form">
                                                                                        @csrf @method('DELETE')
                                                                                        <button type="submit" class="btn btn-xs btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="edit-form" method="POST">
                @csrf @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Menu Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>URL / Slug</label>
                        <input type="text" name="url" id="edit-url" class="form-control" placeholder="e.g. about/about-d-bels">
                    </div>
                    <div class="form-group mb-3">
                        <label>Parent Item</label>
                        <select name="parent_id" id="edit-parent_id" class="form-control form-select">
                            <option value="">� None (top-level) �</option>
                            @foreach ($all_items as $item)
                                @if (!$item->parent_id)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @foreach ($item->children as $child)
                                        <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;? {{ $child->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="edit-status" class="form-control form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<style>
.menu-builder-list,.menu-builder-sublist{list-style:none;padding:0;margin:0}
.menu-builder-sublist{margin-left:32px;margin-top:4px;border-left:3px solid #dee2e6;padding-left:12px}
.menu-builder-item{margin-bottom:6px}
.menu-builder-handle{display:flex;align-items:center;gap:8px;background:#f8f9fa;border:1px solid #dee2e6;border-radius:6px;padding:10px 14px;cursor:grab;user-select:none;transition:background .15s,box-shadow .15s}
.menu-builder-handle:hover{background:#e9f0ff;border-color:#0c54a0;box-shadow:0 2px 8px rgba(12,84,160,.1)}
.drag-icon{color:#adb5bd;font-size:14px;flex-shrink:0}
.menu-builder-name{font-weight:600;font-size:14px;color:#333}
.menu-builder-url{font-size:12px}
.menu-builder-actions{display:flex;gap:4px}
.btn-xs{padding:2px 7px;font-size:11px}
.sortable-ghost .menu-builder-handle{background:#cfe2ff;border:2px dashed #0c54a0;opacity:.7}
.sortable-chosen .menu-builder-handle{box-shadow:0 4px 16px rgba(0,0,0,.15);background:#fff}
#save-order-btn{display:none}
#save-order-btn.visible{display:inline-flex}
</style>
<script>
(function(){
    const REORDER_URL="{{ route('menu-items.reorder') }}";
    const CSRF="{{ csrf_token() }}";
    function makeSortable(el){
        Sortable.create(el,{
            group:'menu',animation:150,handle:'.menu-builder-handle',
            ghostClass:'sortable-ghost',chosenClass:'sortable-chosen',
            fallbackOnBody:true,swapThreshold:0.65,
            onEnd:function(){
                document.getElementById('save-order-btn').classList.add('visible');
            }
        });
    }
    const root=document.getElementById('menu-sortable');
    if(root){
        makeSortable(root);
        root.querySelectorAll('.menu-builder-sublist').forEach(makeSortable);
    }
    document.getElementById('save-order-btn')?.addEventListener('click',function(){
        const items=[];let order=1;
        root.querySelectorAll(':scope > .menu-builder-item').forEach(function(li){
            items.push({id:li.dataset.id,order:order++,parent_id:''});
            const sub=li.querySelector(':scope > .menu-builder-sublist');
            if(sub){let so=1;sub.querySelectorAll(':scope > .menu-builder-item').forEach(function(sl){
                items.push({id:sl.dataset.id,order:so++,parent_id:li.dataset.id});
                const sub2=sl.querySelector(':scope > .menu-builder-sublist');
                if(sub2){let s2o=1;sub2.querySelectorAll(':scope > .menu-builder-item').forEach(function(s2l){
                    items.push({id:s2l.dataset.id,order:s2o++,parent_id:sl.dataset.id});
                });}
            });}
        });
        const btn=document.getElementById('save-order-btn');
        fetch(REORDER_URL,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({items})})
        .then(r=>r.json()).then(d=>{
            if(d.success){
                btn.innerHTML='<i class="fas fa-check me-1"></i> Saved!';btn.classList.add('visible');
                setTimeout(()=>{btn.innerHTML='<i class="fas fa-save me-1"></i> Save Order';btn.classList.remove('visible');},2000);
            }
        }).catch(()=>alert('Failed to save. Please try again.'));
    });
    document.querySelectorAll('.btn-edit').forEach(function(btn){
        btn.addEventListener('click',function(){
            document.getElementById('edit-name').value=this.dataset.name;
            document.getElementById('edit-url').value=this.dataset.url||'';
            document.getElementById('edit-status').value=this.dataset.status;
            document.getElementById('edit-parent_id').value=this.dataset.parent_id||'';
            document.getElementById('edit-form').action="{{ url('admin/menu-item') }}/"+this.dataset.id;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        });
    });
    document.querySelectorAll('.delete-form').forEach(function(form){
        form.addEventListener('submit',function(e){
            if(!confirm('Delete this menu item? Its children will be moved to the parent level.')){e.preventDefault();}
        });
    });
})();
</script>
@endsection
