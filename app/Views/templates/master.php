<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Fee Bootstrap Admin Theme with Webpack and Laravel-Mix" />
    <meta name="keywords" content="bootstrap, admin theme, admin dashboard, jquery, webpack, laravel-mix, template, responsive" />
    <meta name="author" content="siQuang - Simon Nguyen" />

    <title>Master</title>

    <link rel="stylesheet" href="<?=base_url("css/siqtheme.css")?>">

</head>

<body class="theme-dark">
    <div class="grid-wrapper sidebar-bg bg1">

        <!-- Theme switcher -->
        <div id="theme-tab">
            <div class="theme-tab-item switch-theme bg-white" data-theme="theme-default" data-toggle="tooltip" title="Light"></div>
            <div class="theme-tab-item switch-theme bg-dark" data-theme="theme-dark" data-toggle="tooltip" title="Dark"></div>
        </div>

        <!-- BOF HEADER -->
        <div class="header">
            <div class="header-bar">
                <div class="brand">
                    <a href="index.html" class="logo"><span class="text-carolina">siQ</span>theme</a>
                    <a href="index.html" class="logo-sm text-carolina" style="display: none;">siQ</a>
                </div>
                <div class="btn-toggle">
                    <!-- <a href="#" class="toggle-sidebar-btn"><i class="ti-arrow-circle-left"></i></a> -->
                    <a href="#" class="slide-sidebar-btn" style="display: none;"><i class="ti-menu"></i></a>
                </div>
                <div class="navigation d-flex">

                    <!-- BOF Header Search -->
                    <form class="navbar-search" role="search" method="post" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="ti-search"></i></div>
                            </div>
                            <input type="text" placeholder="Search for keywords" class="form-control" name="top-search"
                                id="top-search">
                        </div>
                    </form>
                    <!-- EOF Header Search -->

                    <!-- BOF Header Nav -->
                    <div class="navbar-menu d-flex">
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-alert">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comment-alt"></i> View
                                        All Alerts <i class="ti-angle-right"></i></a></li>
                                <li><a href="#"><i class="fa fa-user"></i> New user registered <span>Just now</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-calendar-plus-o"></i> New event created <span>5 min
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-area-chart"></i> Report ready to download <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-bank"></i> Bill payment reminder <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Staff meeting <span>3 days ago</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                                <i class="ti-email"></i>
                                <span class="badge badge-pill badge-success">7</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-message">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comments"></i> View All
                                        Messages <i class="ti-angle-right"></i></a></li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>24h ago</small>
                                        <a href="#"><span class="message-user">Pear Appleton</span><br>
                                            Staff meeting on Tuesday at 4PM, remember to set date</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>2h ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            RE: Remember to generate PNL for October</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>3d ago</small>
                                        <a href="#"><span class="message-user">Lemony Tang</span><br>
                                            Appointment with lawyer, better call Saul!</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>4d ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            Theme designed by siQuang for siQthemes</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn right-sidebar-toggle"><i class="ti-user"></i></a>
                        </div>
                    </div>
                    <!-- EOF Header Nav -->

                </div>
            </div>
        </div>
        <!-- EOF HEADER -->

        <!-- BOF ASIDE-LEFT -->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-content">
                <!-- sidebar-menu  -->
                <div class="sidebar-menu">
                </div>
                <!-- sidebar-menu  -->
            </div>
        </div>
        <!-- EOF ASIDE-LEFT -->

        <div class="main">
            <?= $this->renderSection("content")?>;
        </div>

        <!-- BOF FOOTER -->
        <div class="footer">
            <p class="text-center">
                <a class="ml-2" href="https://opensource.org/licenses/MIT" target="_blank"><img src="https://img.shields.io/badge/License-MIT-green.svg" alt="siQtheme License"></a>
                <a class="ml-2" href="https://github.com/siQuang/siqtheme/releases" target="_blank"><img src="https://img.shields.io/github/release/siQuang/siqtheme.svg" alt="Github siQtheme"></a>
                <a class="ml-2" href="https://www.npmjs.com/package/siqtheme" target="_blank"><img src="https://img.shields.io/npm/v/siqtheme/latest.svg" alt="NPM siQtheme"></a>
            </p>

            <p class="text-center">Copyright © 2019-2020 siQtheme by <a href="https://siquang.com" target="_blank">3M Square</a>. All rights reserved.</p>
        </div>
        
        <!-- Preloader -->
        <div id="preloader"></div>
        <!-- EOF FOOTER -->

        <!-- BOF ASIDE-RIGHT -->
        <div id="sidebar-right">
            <div class="sidebar-right-container">

                <!-- BOF TABS -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#tab-1" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                    <li>
                        <a href="#tab-2" data-toggle="tab" class="nav-link">Settings</a>
                    </li>
                    <li>
                        <a href="#tab-3" data-toggle="tab" class="nav-link">Help</a>
                    </li>
                </ul>
                <!-- EOF TABS -->

                <!-- BOF TAB PANES -->
                <div class="tab-content">
                    <!-- BOF TAB-PANE #1 -->
                    <div id="tab-1" class="tab-pane show active">
                        <div class="pane-header">
                            <h3><i class="ti-user"></i> User Panel</h3>
                            <i class="fa fa-circle text-success"></i> <span class="profile-user">siQuang
                                Humbleman</span>
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="card bg-transparent mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <h5 class="mb-3">My Theme</h5>
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn switch-theme btn-light" data-theme="theme-default">Light</button>
                                            <button type="button" class="btn switch-theme btn-dark" data-theme="theme-dark">Dark</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="mb-3">My Profile</h5>
                                        <form class="form-update-profile">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Firstname:</label>
                                                <div class="col">
                                                    <input type="text" name="first_name" class="form-control-plaintext"
                                                        value="siQuang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Lastname:</label>
                                                <div class="col">
                                                    <input type="text" name="last_name" class="form-control-plaintext"
                                                        value="Humbleman">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Email:</label>
                                                <div class="col">
                                                    <input type="text" name="email" class="form-control-plaintext"
                                                        value="siquang@example.com">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Username:</label>
                                                <div class="col">
                                                    <input type="text" name="username" class="form-control-plaintext"
                                                        value="siquang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Password:</label>
                                                <div class="col">
                                                    <input type="password" name="password" class="form-control-plaintext"
                                                        value="123456789">
                                                </div>
                                            </div>
                                            <div class="col offset-md-4 pl-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="mb-3">
                                            Messages
                                            <span class="badge badge-pill badge-info pull-right">4</span>
                                        </h5>
                                        <div class="message-group d-flex flex-row mb-3">
                                            <a href="#"><img src="assets/img/profile/profile-01.jpg" class="rounded"
                                                    alt="image"></a>
                                            <div class="message-item">
                                                <small class="text-carolina">Today 3:30 pm</small><br>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            </div>
                                        </div>
                                        <div class="message-group d-flex flex-row mb-3">
                                            <a href="#"><img src="assets/img/profile/profile-03.jpg" class="rounded"
                                                    alt="image"></a>
                                            <div class="message-item">
                                                <small class="text-carolina">Today 12:45 pm</small><br>
                                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                ut aliquip aute irure dolor in.
                                            </div>
                                        </div>
                                        <div class="message-group d-flex flex-row mb-3">
                                            <a href="#"><img src="assets/img/profile/profile-02.jpg" class="rounded"
                                                    alt="image"></a>
                                            <div class="message-item">
                                                <small class="text-carolina">Yesterday 5:20 pm</small><br>
                                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                                dolore eu fugiat nulla pariatur.
                                            </div>
                                        </div>
                                        <div class="message-group d-flex flex-row">
                                            <a href="#"><img src="assets/img/profile/profile-05.jpg" class="rounded"
                                                    alt="image"></a>
                                            <div class="message-item">
                                                <small class="text-carolina">Tuesday 2:20 pm</small><br>
                                                Sunt in culpa qui officia deserunt mollit anim est laborum voluptate.
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>Upcoming Events</h5>
                                        <p class="card-text">for Monday - February 25, 2019</p>
                                        <div class="profile-calendar">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Schedule</th>
                                                        <th scope="col">Events</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>All-day</td>
                                                        <td><i class="fa fa-circle text-info"></i> Project concept</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10:00 am</td>
                                                        <td><i class="fa fa-circle text-info"></i> Staff meeting</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2:50 pm</td>
                                                        <td><i class="fa fa-circle text-warning"></i> Send out report
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4:30 pm</td>
                                                        <td><i class="fa fa-circle text-danger"></i> Appointment with
                                                            Tang</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #1 -->

                    <!-- BOF TAB-PANE #2 -->
                    <div id="tab-2" class="tab-pane">
                        <div class="pane-header">
                            <h3><i class="ti-settings"></i> Settings</h3>
                            Application Settings
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="card bg-transparent mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <h5 class="text-carolina"><i class="ti-user"></i> User Settings</h5>
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm">
                                        Notifications
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm"> Dashboard
                                        Graphs
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm" data-on="Yes"
                                            data-off="No"> Get Daily Feed
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="text-carolina"><i class="ti-world"></i> Global Settings</h5>
                                        Global settings are only accessible by a super administrator or admin group.
                                        These settings control the application globally.
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Show Subscription
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm"> SMTP Server
                                        <div class="row mt-3">
                                            <div class="input-group input-group-sm col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">SMTP</span>
                                                </div>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm" data-on="Yes"
                                            data-off="No"> Send Out Daily Report
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Send Daily Cron Report
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Backup Database Daily
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #2 -->

                    <!-- BOF TAB-PANE #3 -->
                    <div id="tab-3" class="tab-pane">
                        <div class="pane-header">
                            <h3><i class="ti-agenda"></i> Help</h3>
                            Frequently Asked Questions
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="accordion" id="faq-example">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#faq1">
                                                Frequently Asked Question #1
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq1" class="collapse show" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq2">
                                                Frequently Asked Question #2
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq2" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq3">
                                                Frequently Asked Question #3
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq3" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq4">
                                                Frequently Asked Question #4
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq4" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq5">
                                                Frequently Asked Question #5
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq5" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq6">
                                                Frequently Asked Question #6
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq6" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq7">
                                                Frequently Asked Question #7
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq7" class="collapse" data-parent="#faq-example">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #3 -->
                </div>
                <!-- EOF TAB PANES -->

            </div>
        </div>
        <!-- EOF ASIDE-RIGHT -->

        <div id="overlay"></div>

    </div> <!-- END WRAPPER -->

    <script src="<?=base_url("js/siqtheme.js")?>"></script>

</body>

</html>