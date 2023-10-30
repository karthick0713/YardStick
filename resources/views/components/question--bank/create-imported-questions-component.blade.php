<div class="col-12">
    <div class="mb-2">
        <button class="button-plus-icon"><i class='plus-icon bx bxs-plus-circle'></i></button>
    </div>
    <div class="table-container">
        <table id="dataTable" class="table table-responsive table-stripped ">
            <thead class="">
                <tr class="background-secondary">
                    <th scope="col" class="text-white">CODE</th>
                    <th scope="col" class="text-white">TITLE</th>
                    <th scope="col" class="text-white">CATEGORY</th>
                    <th scope="col" class="text-white">TYPE</th>
                    <th scope="col" class="text-white">VISIBILITY</th>
                    <th scope="col" class="text-white">STATUS</th>
                    <th scope="col" class="text-white">ACTIONS</th>
                </tr>
                <tr class="background-grey">
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Code " id="searchCode">
                    </td>
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Title " id="searchTitle">
                    </td>
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Category " id="searchCategory">
                    </td>
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Type " id="searchType">
                    </td>
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Visibility " id="searchVisibility">
                    </td>
                    <td><input type="search" name="" class="form-control table-search-bar"
                            placeholder="Search Status " id="searchStatus">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
            <tbody>



                <tr>
                    <td>JAVA-A001</td>
                    <td>Hello World</td>
                    <td>Program</td>
                    <td>Context</td>
                    <td>Private</td>
                    <td>Published</td>
                    <td>
                        <div class="dropdown">
                            <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                data-toggle="dropdown" onclick="toggleDropdown(this)">

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="performAction('View', this)">View</a>
                                <a class="dropdown-item" href="#" onclick="performAction('Edit', this)">Edit</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Delete', this)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>PHP-A001</td>
                    <td>Hello World</td>
                    <td>Program</td>
                    <td>Context</td>
                    <td>Private</td>
                    <td>Published</td>
                    <td>
                        <div class="dropdown">
                            <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                data-toggle="dropdown" onclick="toggleDropdown(this)">

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="performAction('View', this)">View</a>
                                <a class="dropdown-item" href="#" onclick="performAction('Edit', this)">Edit</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Delete', this)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>PYTHON-A001</td>
                    <td>Hello World</td>
                    <td>Program</td>
                    <td>Context</td>
                    <td>Private</td>
                    <td>Published</td>
                    <td>
                        <div class="dropdown">
                            <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                data-toggle="dropdown" onclick="toggleDropdown(this)">

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="performAction('View', this)">View</a>
                                <a class="dropdown-item" href="#" onclick="performAction('Edit', this)">Edit</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Delete', this)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>JAVA-A001</td>
                    <td>Hello World</td>
                    <td>Program</td>
                    <td>Context</td>
                    <td>public</td>
                    <td>unpublished</td>
                    <td>
                        <div class="dropdown">
                            <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                data-toggle="dropdown" onclick="toggleDropdown(this)">

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('View', this)">View</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Edit', this)">Edit</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Delete', this)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>JAVA-A001</td>
                    <td>Hello World</td>
                    <td>Event</td>
                    <td>Context</td>
                    <td>Private</td>
                    <td>Published</td>
                    <td>
                        <div class="dropdown">
                            <input class=" dropdown-toggle action-toggle" value="Actions" readonly
                                data-toggle="dropdown" onclick="toggleDropdown(this)">

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('View', this)">View</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Edit', this)">Edit</a>
                                <a class="dropdown-item" href="#"
                                    onclick="performAction('Delete', this)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>