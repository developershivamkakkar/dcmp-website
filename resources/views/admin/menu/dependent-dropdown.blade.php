@extends('admin/layouts/app')

@section('admin-title', 'Page Editor – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit website pages and manage page content')
@section('admin-keywords', 'page editor, content, pages, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Page Editor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Page Editor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                {{-- Toast --}}
                <div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index:9999">
                    <div id="pe-toast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body" id="pe-toast-msg"></div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                {{-- Selector card --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-sitemap me-2"></i>
                        <h3 class="card-title mb-0">Select Page</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Parent Menu</label>
                                <select id="parentMenu" class="form-control">
                                    <option value="">� Select parent menu �</option>
                                    @foreach ($menu_items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Sub Menu</label>
                                <select id="subMenu" class="form-control">
                                    <option value="">� Select sub menu �</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end gap-2">
                                <button id="btnLoad" class="btn btn-primary" type="button" disabled>
                                    <i class="fas fa-folder-open me-1"></i> Load
                                </button>
                                <div id="pe-loading" class="text-muted d-none ms-2">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </div>
                            </div>
                        </div>
                        {{-- Info shown when parent is a dropdown (has children) --}}
                        <div id="pe-dropdown-info" class="alert alert-info mt-3 mb-0 d-none">
                            <i class="fas fa-info-circle me-1"></i>
                            This menu item is a <strong>dropdown</strong> and does not have its own page. Please select a sub menu item to edit its page.
                        </div>
                    </div>
                </div>

                {{-- Editor card (hidden until Load is clicked) --}}
                <div id="editorCard" class="card d-none">
                    <div class="card-header bg-secondary text-white d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0" id="editorCardTitle">�</h3>
                        <span class="badge bg-light text-dark" id="editorCardBadge"></span>
                    </div>
                    <div class="card-body">
                        <form id="pageEditorForm">
                            @csrf
                            <input type="hidden" id="menuItemId" name="menu_item_id" value="">

                            <div class="form-group mb-3">
                                <label for="pageTitle" class="form-label fw-semibold">Page Title</label>
                                <input id="pageTitle" name="title" type="text" class="form-control"
                                       placeholder="Enter page title...">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Content</label>
                                <textarea id="editor" name="content"></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save Page
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('scripts')
<script>
(function () {
    var parentSel    = document.getElementById('parentMenu');
    var subSel       = document.getElementById('subMenu');
    var btnLoad      = document.getElementById('btnLoad');
    var editorCard   = document.getElementById('editorCard');
    var loading      = document.getElementById('pe-loading');
    var form         = document.getElementById('pageEditorForm');
    var dropInfo     = document.getElementById('pe-dropdown-info');

    // Track whether the current parent has sub-menus
    var parentHasSubs = false;

    // -- Toast helper -------------------------------------------------
    function showToast(msg, type) {
        type = type || 'success';
        var toast = document.getElementById('pe-toast');
        var txt   = document.getElementById('pe-toast-msg');
        txt.textContent = msg;
        toast.className = 'toast align-items-center border-0 text-white bg-' + type;
        var bsToast = bootstrap.Toast.getOrCreateInstance(toast, { delay: 3500 });
        bsToast.show();
    }

    function setLoading(on) {
        loading.classList.toggle('d-none', !on);
        btnLoad.disabled = on;
    }

    function updateLoadBtn() {
        if (parentHasSubs) {
            // Parent is a dropdown � only enable Load when a sub is selected
            btnLoad.disabled = !subSel.value;
        } else {
            // Parent is a leaf � enable if parent selected
            btnLoad.disabled = !parentSel.value;
        }
    }

    // -- Parent change ------------------------------------------------
    parentSel.addEventListener('change', function () {
        var parentId = this.value;

        subSel.innerHTML = '<option value="">� Select sub menu �</option>';
        editorCard.classList.add('d-none');
        dropInfo.classList.add('d-none');
        parentHasSubs = false;
        btnLoad.disabled = true;

        if (!parentId) return;

        setLoading(true);

        fetch('sub-menus/' + parentId)
            .then(function(r){ return r.json(); })
            .then(function(subs) {
                setLoading(false);
                if (Object.keys(subs).length > 0) {
                    parentHasSubs = true;
                    Object.entries(subs).forEach(function(entry) {
                        var opt = document.createElement('option');
                        opt.value = entry[0];
                        opt.textContent = entry[1];
                        subSel.appendChild(opt);
                    });
                    // Show info: parent is a dropdown, must pick a sub
                    dropInfo.classList.remove('d-none');
                }
                updateLoadBtn();
            })
            .catch(function(){
                setLoading(false);
                showToast('Failed to load sub menus.', 'danger');
                updateLoadBtn();
            });
    });

    subSel.addEventListener('change', function () {
        editorCard.classList.add('d-none');
        if (this.value) dropInfo.classList.add('d-none');
        else if (parentHasSubs) dropInfo.classList.remove('d-none');
        updateLoadBtn();
    });

    // -- Load button --------------------------------------------------
    btnLoad.addEventListener('click', function () {
        var subVal    = subSel.value;
        var parentVal = parentSel.value;

        // If parent has subs but none selected, block
        if (parentHasSubs && !subVal) {
            showToast('This menu is a dropdown. Please select a sub menu item.', 'warning');
            return;
        }

        var id    = subVal || parentVal;
        var label = subVal
            ? subSel.options[subSel.selectedIndex].text
            : parentSel.options[parentSel.selectedIndex].text;

        loadPage(id, label);
    });

    // -- Load page data -----------------------------------------------
    function loadPage(menuItemId, menuName) {
        setLoading(true);
        editorCard.classList.add('d-none');

        fetch('{{ url("admin/page/data") }}/' + menuItemId)
            .then(function(r){ return r.json(); })
            .then(function(data) {
                setLoading(false);
                document.getElementById('menuItemId').value            = data.id;
                document.getElementById('pageTitle').value             = data.title || '';
                document.getElementById('editorCardTitle').textContent = menuName;
                document.getElementById('editorCardBadge').textContent = 'ID: ' + data.id;

                if (window.editor) {
                    window.editor.setData(data.content || '');
                } else {
                    document.getElementById('editor').value = data.content || '';
                }

                editorCard.classList.remove('d-none');
            })
            .catch(function(){
                setLoading(false);
                showToast('Failed to load page data.', 'danger');
            });
    }

    // -- Save ---------------------------------------------------------
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (window.editor) {
            document.getElementById('editor').value = window.editor.getData();
        }

        var fd = new FormData(form);
        fd.set('content', document.getElementById('editor').value);

        fetch('{{ route("page.save") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: fd,
        })
        .then(function(r) {
            if (r.ok || r.redirected) {
                showToast('Content saved successfully!', 'success');
            } else {
                return r.text().then(function(t){ throw new Error(t); });
            }
        })
        .catch(function(err) {
            console.error(err);
            showToast('Failed to save page. Please try again.', 'danger');
        });
    });
})();
</script>
@endsection
