<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- -- SEO: Title ---------------------------------------------------- --}}
    <title>@yield('admin-title', config('site.name') . ' Admin Panel')</title>

    {{-- -- SEO: Meta Tags ------------------------------------------------ --}}
    <meta name="description" content="@yield('admin-description', 'Admin Panel for ' . config('site.full_name'))">
    <meta name="keywords" content="@yield('admin-keywords', 'admin, dashboard, management')">
    <meta name="robots" content="@yield('admin-robots', 'noindex, nofollow')">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/custom.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset(config('site.favicon')) }}">

    {{-- BOOTSTRAP 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- CK Editor CDN --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lora:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }

        /* -- CKEditor WYSIWYG body � mirrors frontend .page-editor styles -- */
        .ck.ck-editor {
            width: 100% !important;
            display: block !important;
        }
        .ck.ck-editor__main,
        .ck.ck-editor__top,
        .ck.ck-toolbar {
            width: 100% !important;
        }
        .ck-editor__editable_inline {
            width: 100% !important;
            box-sizing: border-box !important;
            white-space: normal !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            word-break: normal !important;
            overflow-x: hidden !important;
            font-size: 15.5px !important;
            line-height: 1.85 !important;
            color: #2d2d2d !important;
            min-height: 420px;
            padding: 24px 28px !important;
        }
        .ck-editor__editable_inline p {
            font-family: 'Poppins', sans-serif !important;
            font-size: 15.5px !important;
            line-height: 1.85 !important;
            color: #2d2d2d !important;
            margin-bottom: 1.1rem;
        }
        .ck-editor__editable_inline span {
            color: inherit !important;
            font-size: inherit !important;
            font-family: inherit !important;
            background-color: transparent !important;
        }
        .ck-editor__editable_inline h1,
        .ck-editor__editable_inline h2,
        .ck-editor__editable_inline h3,
        .ck-editor__editable_inline h4,
        .ck-editor__editable_inline h5,
        .ck-editor__editable_inline h6 {
            font-family: 'Lora', serif !important;
            color: #0c54a0 !important;
            margin-top: 1.6rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        .ck-editor__editable_inline h2 {
            border-left: 4px solid #00A859;
            padding-left: 12px;
        }
        .ck-editor__editable_inline a { color: #0c54a0; text-decoration: underline; }
        .ck-editor__editable_inline blockquote {
            border-left: 4px solid #00A859;
            padding: 12px 20px;
            background: #edf3fb;
            border-radius: 0 8px 8px 0;
            color: #555;
            margin: 1.5rem 0;
            font-style: italic;
        }
        .ck-editor__editable_inline ul,
        .ck-editor__editable_inline ol { padding-left: 1.5rem; margin-bottom: 1rem; }
        .ck-editor__editable_inline li { margin-bottom: 0.4rem; color: #2d2d2d !important; font-size: 15.5px; }
        .ck-editor__editable_inline table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            margin-bottom: 1.5rem;
        }
        .ck-editor__editable_inline table th {
            background-color: #0c54a0 !important;
            color: #fff !important;
            font-weight: 600;
            padding: 12px 16px;
            border: none;
        }
        .ck-editor__editable_inline table td {
            padding: 11px 16px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        .ck-editor__editable_inline table tr:nth-child(even) td { background-color: #f8f9fc; }
        .ck-editor__editable_inline table tr:hover td { background-color: #fdf8ee; }
        .ck-editor__editable_inline img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        }
        .ck-editor__editable_inline hr { border: none; border-top: 2px solid #f0f0f0; margin: 2rem 0; }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user"></i> {{ auth()->user()->roles->pluck('name')->first() }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}">
                            Logout
                        </a>
                        <form id="logout-form" action="#" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link bg-white" style="height: 57px;">
                <img src="{{ asset('storage/assets/dcmp-logo.png') }}" alt="dcmp Logo"
                    class="brand-image img-circle elevation-1">
                <span class="brand-text font-weight-dark">{{ config('site.name') }} Admin Panel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @if (auth()->user()->can('module-hero-banners'))
                            <li class="nav-item">
                                <a href="{{ route('banners.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hero-Banners</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-explore-banners'))
                            <li class="nav-item">
                                <a href="{{ route('explore-banners.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Explore-Banners</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-gallery'))
                            <li class="nav-item">
                                <a href="{{ route('gallery.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage-Gallery</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-announcements'))
                            <li class="nav-item">
                                <a href="{{ route('announcements.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Announcements</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-faqs'))
                            <li class="nav-item">
                                <a href="{{ route('admin.faqs.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>FAQs</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-testimonials'))
                            <li class="nav-item">
                                <a href="{{ route('admin.testimonials.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Opinion That Matters</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-manage-learning-partners'))
                            <li class="nav-item">
                                <a href="{{ route('admin.learning-partners.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Learning Partners</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-resource-list'))
                            <li class="nav-item">
                                <a href="{{ route('resources.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Resource List</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-popups'))
                            <li class="nav-item">
                                <a href="{{ route('popups.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Popups</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-mandatory-disclosure'))
                            <li class="nav-item">
                                <a href="{{ route('md.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mandatory Disclosure</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('view roles'))
                            <li class="nav-item">
                                <a href="{{ route('roles.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Roles</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('view permissions'))
                            <li class="nav-item">
                                <a href="{{ route('permissions.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Permissions</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('view users'))
                            <li class="nav-item">
                                <a href="{{ route('users.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Users</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-achievements'))
                            <li class="nav-item">
                                <a href="{{ route('admin.achievements.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Achievements</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-downloads'))
                            <li class="nav-item">
                                <a href="{{ route('downloads.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Downloads</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-transfer-certificates'))
                            <li class="nav-item">
                                <a href="{{ route('admin.tc.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transfer Certificates</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-blogs'))
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blogs</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-events'))
                            <li class="nav-item">
                                <a href="{{ route('admin.events.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Events</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('module-enquires'))
                            <li class="nav-item">
                                <a href="{{ route('contacts.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contact Form Enquires</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-job-enquires'))
                            <li class="nav-item">
                                <a href="{{ route('admin.job-enquires.get') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Job Form Enquires</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-manage-menu-items'))
                            <li class="nav-item">
                                <a href="{{ route('menu-items.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Menu Items</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-page-editor'))
                            <li class="nav-item">
                                <a href="{{ route('dependent-dropdown') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Page Editor</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-site-settings'))
                            <li class="nav-item">
                                <a href="{{ route('admin.site-settings.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Website Settings</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('module-landing-page'))
                            <li class="nav-item">
                                <a href="{{ route('admin.landing-page.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Landing Page Editor</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.logout') }}" class="nav-link">
                                <i class='fas fa-sign-out-alt nav-icon'></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        {{-- Yield main content --}}
        @yield('main')

        @yield('scripts')

        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 </strong>All rights reserved. Developed with ? by developerShivam
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('admin_assets/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/adminlte.min.js?v=3.2.0') }}"></script>

    {{-- Bootstrap -5 scriptt --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/878eb3871c.js" crossorigin="anonymous"></script>

    {{-- Ck Editor --}}
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            /* -- Core --------------------------------------- */
            Essentials, Paragraph, SelectAll,
            /* -- Text formatting --------------------------- */
            Bold, Italic, Underline, Strikethrough, Code,
            Subscript, Superscript, RemoveFormat,
            /* -- Fonts ------------------------------------- */
            Font, FontSize, FontFamily, FontColor, FontBackgroundColor,
            /* -- Headings & structure ---------------------- */
            Heading, HorizontalLine, PageBreak, BlockQuote,
            /* -- Alignment & indent ------------------------ */
            Alignment, Indent, IndentBlock,
            /* -- Lists ------------------------------------- */
            List, ListProperties, TodoList,
            /* -- Link -------------------------------------- */
            Link, LinkImage, AutoLink,
            /* -- Image ------------------------------------- */
            Image, ImageCaption, ImageInsert, ImageResize,
            ImageResizeEditing, ImageResizeHandles,
            ImageStyle, ImageTextAlternative, ImageToolbar, ImageUpload,
            AutoImage, SimpleUploadAdapter,
            /* -- Table ------------------------------------- */
            Table, TableCaption, TableCellProperties,
            TableColumnResize, TableProperties, TableToolbar,
            /* -- Media & code ------------------------------ */
            MediaEmbed, CodeBlock,
            /* -- Special characters ------------------------ */
            SpecialCharacters, SpecialCharactersArrows,
            SpecialCharactersCurrency, SpecialCharactersEssentials,
            SpecialCharactersLatin, SpecialCharactersMathematical,
            SpecialCharactersText,
            /* -- Advanced ---------------------------------- */
            FindAndReplace, Highlight, ShowBlocks, SourceEditing,
            GeneralHtmlSupport, HtmlEmbed,
            Autoformat, TextTransformation,
            PasteFromOffice, Clipboard,
            WordCount,
        } from 'ckeditor5';

        const editorEl = document.querySelector('#editor');
        if (editorEl) {

        ClassicEditor
            .create(editorEl, {
                plugins: [
                    Essentials, Paragraph, SelectAll,
                    Bold, Italic, Underline, Strikethrough, Code,
                    Subscript, Superscript, RemoveFormat,
                    Font, FontSize, FontColor, FontBackgroundColor,
                    Heading, HorizontalLine, PageBreak, BlockQuote,
                    Alignment, Indent, IndentBlock,
                    List, ListProperties, TodoList,
                    Link, LinkImage, AutoLink,
                    Image, ImageCaption, ImageInsert, ImageResize,
                    ImageResizeEditing, ImageResizeHandles,
                    ImageStyle, ImageTextAlternative, ImageToolbar, ImageUpload,
                    AutoImage, SimpleUploadAdapter,
                    Table, TableCaption, TableCellProperties,
                    TableColumnResize, TableProperties, TableToolbar,
                    MediaEmbed, CodeBlock,
                    SpecialCharacters, SpecialCharactersArrows,
                    SpecialCharactersCurrency, SpecialCharactersEssentials,
                    SpecialCharactersLatin, SpecialCharactersMathematical,
                    SpecialCharactersText,
                    FindAndReplace, Highlight, ShowBlocks, SourceEditing,
                    GeneralHtmlSupport, HtmlEmbed,
                    Autoformat, TextTransformation,
                    PasteFromOffice, Clipboard,
                    WordCount,
                ],

                toolbar: {
                    shouldNotGroupWhenFull: true,
                    items: [
                        'undo', 'redo', '|',
                        'findAndReplace', 'selectAll', '|',
                        'sourceEditing', 'showBlocks', '|',
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'code',
                        'subscript', 'superscript', 'removeFormat', '|',
                        'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'link', 'insertImage', 'mediaEmbed', 'insertTable',
                        'blockQuote', 'codeBlock', '|',
                        'horizontalLine', 'pageBreak', '|',
                        'highlight', 'specialCharacters', 'htmlEmbed',
                    ]
                },

                heading: {
                    options: [
                        { model: 'paragraph',  title: 'Paragraph',  class: 'ck-heading_paragraph'  },
                        { model: 'heading1',   view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2',   view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3',   view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4',   view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5',   view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6',   view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
                    ]
                },

                fontSize: {
                    options: [ 10, 11, 12, 14, 'default', 18, 20, 22, 24, 28, 32, 36, 48 ],
                    supportAllValues: true
                },

                mediaEmbed: {
                    previewsInData: true,
                    providers: [
                        {
                            name: 'youtube',
                            url: [
                                /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)/,
                                /^(?:m\.)?youtube\.com\/v\/([\w-]+)/,
                                /^youtube\.com\/shorts\/([\w-]+)/,
                                /^youtu\.be\/([\w-]+)/,
                            ],
                            html: match =>
                                `<div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">` +
                                `<iframe src="https://www.youtube.com/embed/${match[1]}" ` +
                                `style="position:absolute;top:0;left:0;width:100%;height:100%;" ` +
                                `frameborder="0" allow="accelerometer;autoplay;clipboard-write;` +
                                `encrypted-media;gyroscope;picture-in-picture" allowfullscreen></iframe></div>`
                        }
                    ]
                },

                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },

                link: {
                    decorators: {
                        openInNewTab: {
                            mode: 'manual',
                            label: 'Open in a new tab',
                            attributes: { target: '_blank', rel: 'noopener noreferrer' }
                        }
                    }
                },

                image: {
                    resizeUnit: '%',
                    resizeOptions: [
                        { name: 'resizeImage:original', value: null,  label: 'Original' },
                        { name: 'resizeImage:25',       value: '25',  label: '25%'      },
                        { name: 'resizeImage:50',       value: '50',  label: '50%'      },
                        { name: 'resizeImage:75',       value: '75',  label: '75%'      },
                        { name: 'resizeImage:100',      value: '100', label: '100%'     },
                    ],
                    toolbar: [
                        'imageTextAlternative', 'toggleImageCaption', '|',
                        'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', '|',
                        'resizeImage',
                    ]
                },

                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells', '|',
                        'tableProperties', 'tableCellProperties', '|',
                        'toggleTableCaption'
                    ]
                },

                htmlSupport: {
                    allow: [
                        { name: /.*/, attributes: true, classes: true, styles: true }
                    ]
                },

                simpleUpload: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                },

                wordCount: {
                    onUpdate: stats => {
                        const el = document.getElementById('ck-word-count');
                        if (el) el.textContent = `Words: ${stats.words} | Characters: ${stats.characters}`;
                    }
                }
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('CKEditor init error:', error);
            });

        } // end if (editorEl)
    </script>


    {{-- JS FOR SESSION ALERT --}}
    <script>
        setTimeout(() => {
            const sessionAlert = document.getElementById("session-alert");
            if (sessionAlert) {
                sessionAlert.style.display = "none";
            }
        }, 2000);
    </script>


</body>

</html>
