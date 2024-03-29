@extends('layouts.user')

@section('content')

    @include('partials.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Start Navbar -->
        @include('partials.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Project's List</h6>
                        </div>
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0"></h5>
                                </div>
                                <a href="{{ route('project.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                    type="button">+&nbsp;{{ __('Add Project') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-header pb-0">

                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                <select name="os" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?os=[^&]*/g, '') + '&os=' + this.value : '?os=' + this.value);">
                                    <option selected disabled>OS</option>
                                    @foreach($operatingSystems as $operatingSystem)
                                        <option value="{{$operatingSystem->id}}" {{$operatingSystem->id == request()->query('os') ? 'selected' : ''}} >{{$operatingSystem->name}}</option>
                                    @endforeach
                                </select>


                                    <select name="language" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?language=[^&]*/g, '') + '&language=' + this.value : '?language=' + this.value);" >
                                        <option selected disabled value="">Languages</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" {{$language->id == request()->query('language') ? 'selected' : ''}} >{{$language->name}}</option>
                                        @endforeach
                                    </select>

                                    <select name="framework"  onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?framework=[^&]*/g, '') + '&framework=' + this.value : '?framework=' + this.value);" >
                                        <option selected disabled value="">Frameworks</option>
                                        @foreach($frameworks as $framework)
                                            <option value="{{$framework->id}}" {{$framework->id == request()->query('framework') ? 'selected' : ''}} >{{$framework->name}}</option>
                                        @endforeach
                                    </select>

                                    <select  name="database" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?database=[^&]*/g, '') + '&database=' + this.value : '?database=' + this.value);" >
                                        <option selected disabled value="">Databases</option>
                                        @foreach($databases as $database)
                                            <option value="{{$database->id}}" {{$database->id == request()->query('database') ? 'selected' : ''}} >{{$database->name}}</option>
                                        @endforeach
                                    </select>
                                        
                                    <select  name="is_dr" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?is_dr=[^&]*/g, '') + '&is_dr=' + this.value : '?is_dr=' + this.value);" >
                                            <option selected disabled value="">DR Conf.</option>
                                            <option value="YES" {{ 'YES'== request()->query('is_dr') ? 'selected' : ''}} >YES</option>
                                            <option value="NO" {{'NO' == request()->query('is_dr') ? 'selected' : ''}} >NO</option>
                                    </select>

                                    <select  name="is_vapt_done" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?is_vapt_done=[^&]*/g, '') + '&is_vapt_done=' + this.value : '?is_vapt_done=' + this.value);" >
                                            <option selected disabled value="">Vapt Done</option>
                                            <option value="YES" {{'YES' == request()->query('is_vapt_done') ? 'selected' : ''}} >YES</option>
                                            <option value="NO" {{'NO' == request()->query('is_vapt_done') ? 'selected' : ''}} >NO</option>
                                    </select>

                                    <select  name="is_backup" onchange="window.location.href = '{{ route('project.index') }}' + (location.search ? location.search.replace(/&?is_backup=[^&]*/g, '') + '&is_backup=' + this.value : '?is_backup=' + this.value);" >
                                            <option selected disabled value="">Is Back-Up Configured</option>
                                            <option value="YES" {{'YES' == request()->query('is_backup') ? 'selected' : ''}} >YES</option>
                                            <option value="NO" {{'NO' == request()->query('is_backup') ? 'selected' : ''}} >NO</option>
                                    </select>
                                </div>

                                <form action="{{route('project.index.filter')}}" method="post" >
                                    @csrf
                                    <input type="text" name="text" id="">
                                    <input type="submit" value="Search">
                                </form>

                          </div>
                      </div>
                        <div class="card-body px-0 pt-0 pb-2">

                            @if ($errors->any())
                                <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                        {{ $errors->first() }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                    role="alert">
                                    <span class="alert-text text-white">
                                        {{ session('success') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name 
                                                <a href="{{ route('project.index.sort',['sort' => 'name', 'by' => 'asc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                                </svg>
                                                </a>

                                                <a href="{{ route('project.index.sort',['sort' => 'name', 'by' => 'desc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                                  </svg>
                                                </a>

                                              </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                OS / Version

                                                <a href="{{ route('project.index.sort',['sort' => 'os', 'by' => 'asc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                                </svg>
                                                </a>

                                                <a href="{{ route('project.index.sort',['sort' => 'os', 'by' => 'desc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                                  </svg>
                                                </a>
                                              </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Language / Versoin
                                                <a href="{{ route('project.index.sort',['sort' => 'lang', 'by' => 'asc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                                </svg>
                                                </a>

                                                <a href="{{ route('project.index.sort',['sort' => 'lang', 'by' => 'desc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                                  </svg>
                                                </a>
                                              </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Framework / Versoin
                                                <a href="{{ route('project.index.sort',['sort' => 'framework', 'by' => 'asc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                                </svg>
                                                </a>

                                                <a href="{{ route('project.index.sort',['sort' => 'framework', 'by' => 'desc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                                  </svg>
                                                </a>
                                              </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Database / Versoin
                                                <a href="{{ route('project.index.sort',['sort' => 'db', 'by' => 'asc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                                </svg>
                                                </a>

                                                <a href="{{ route('project.index.sort',['sort' => 'db', 'by' => 'desc']) }}" style="font-size: 12px" >
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                                  </svg>
                                                </a>
                                              </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Exposed To Content</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DR</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vapt Done</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Backup</th>
                                            <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> -->
                                            <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> -->
                                            <th class="text-secondary opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if (isset($projects) && $projects->count() >= 1)
                                            @foreach ($projects as $index => $project)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <!-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> -->
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $project->name }}</h6>
                                                                <p class="text-xs text-secondary mb-0"><a
                                                                        href="">{{ $project->url }}</a></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $project->operatingSystem->name }}</p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->operating_system_version }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $project->getLanguage->name }}</p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->language_version }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $project->getFramework->name }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->framework_version }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $project->getDatabase->name }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->database_version }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $project->is_exposed_to_content }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $project->is_dr }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $project->is_vapt_done }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $project->is_backup }}
                                                        </p>
                                                    </td>

                                                    <td class="align-middle">
                                                        <a href="{{ route('view.website',$project->id) }}"
                                                            class="text-secondary font-weight-bold text-xs"
                                                            data-toggle="tooltip" data-original-title="Edit user">
                                                            View
                                                        </a>
                                                        &nbsp|&nbsp
                                                        <a href="{{ route('edit.website',$project->id) }}"
                                                            class="text-secondary font-weight-bold text-xs"
                                                            data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                        &nbsp|&nbsp
                                                        <a href="{{ route('delete.website', $project->id) }}"
                                                          class="text-secondary font-weight-bold text-xs"
                                                          data-toggle="tooltip"
                                                          data-original-title="Delete website"
                                                          id="deleteWebsiteLink"
                                                          onclick="return confirm('Are you sure you want to delete this website?');">
                                                          Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <!-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> -->
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs font-weight-bold mb-0"></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">No Records Found</p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>

                                                <td class="align-middle">
                                                    <p class="text-xs font-weight-bold mb-0"></p>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $projects->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('osSelect').onchange = function() {
            var selectedOs = this.value;
            if (selectedOs) {
                window.location.href = "{{ route('project.index') }}?os=" + selectedOs;
            }
        };
    </script>


@endsection
