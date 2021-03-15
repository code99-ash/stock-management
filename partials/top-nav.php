<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top px-5 shadow-sm" id="top-nav">

    <a class="navbar-brand brand-text text-light" href="#">
        <span class="h4 mb-1">ACE</span>
    </a>
    
    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    
    <div class="collapse navbar-collapse nav-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            
            <li class="nav-item active">
                <a class="nav-link top-link ml-3" href="<?php $rel."sales/" ?>">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown ml-3">
                <a class="nav-link dropdown-toggle top-link" href="#" id="dropdownId2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Stocks</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId2">
                <a class="dropdown-item" href='<?php echo $rel."stocks/" ?>'>View Stocks</a>
                <a class="dropdown-item" href='<?php echo $rel."stocks/new-stock/" ?>'>New Stock</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link top-link ml-3" href='<?php echo $rel."sales" ?>'>Sales</a>
            </li>
            <li class="nav-item dropdown ml-3">
                <a class="nav-link dropdown-toggle top-link" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Staffs</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href='<?php echo $rel."staffs/new-staff/" ?>'>New Staff</a>
                <a class="dropdown-item" href="#">View Staffs</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle top-link" href="#" id="username" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ikhlas</a>
                <div class="dropdown-menu" aria-labelledby="username">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="btn btn-default dropdown-item" onclick="logout()">Logout</a>
                </div>
            </li>
        </ul>
        
    </div>
</nav>

<script>
    function logout() {
        sessionStorage.removeItem('_ud');
        window.location.reload(true)
    }
</script>