 <nav id="sidebar" class="sidebar js-sidebar">
     <div class="sidebar-content js-simplebar" style="">
         <a class="sidebar-brand" href="{{ route('dashboard') }}">
             <div style="position:relative;top:5px;">
                 <img src="Images/s.png" alt="Student-Management-System" style="width:30px;height:30px;" />
                 <span class="align-middle" style=" font-size:15px !important; ">Student Management</span>
             </div>
         </a>
         {{-- <hr style="position:relative;top:-50px; color:white;" /> --}}

         <ul class="sidebar-nav" style="">
             <li class="sidebar-header">
                 Pages
             </li>

             <li id="dashboard" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('dashboard') }}">
                     <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                 </a>
             </li>
             <li id="classStructure" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('classStructure') }}">
                     <i class="align-middle" data-feather="align-justify"></i> <span class="align-middle">Class
                         Structure</span>
                 </a>
             </li>
             <li id="class_room" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('class_room') }}">
                     <i class="align-middle" data-feather="home"></i> <span class="align-middle">class_room</span>
                 </a>
             </li>
             <li id="teachers" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('teachers') }}">
                     <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Teacher</span>
                 </a>
             </li>
             <li id="students" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('students') }}">
                     <i class="align-middle" data-feather="users"></i> <span class="align-middle">Student</span>
                 </a>
             </li>

             <li id="exam" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('exam') }}">
                     <i class="align-middle" data-feather="arrow-down-circle"></i> <span class="align-middle">Register
                         Exam</span>
                 </a>
             </li>

             <li id="grading" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('grading') }}">
                     <i class="align-middle" data-feather="edit-2"></i> <span class="align-middle">Grading</span>
                 </a>
             </li>

             <li id="examReport" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('examReport') }}">
                     <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">Exam Report</span>
                 </a>
             </li>
             {{-- <li class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('analysis') }}">
             <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">Analysis</span>
             </a>
             </li> --}}
             <li id="document" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('document') }}">
                     <i class="align-middle" data-feather="file"></i> <span class="align-middle">Document</span>
                 </a>
             </li>

             <li id="email" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('email') }}">
                     <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Email</span>
                 </a>
             </li>
             <li id="profile" class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('profile.edit') }}">
                     <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                 </a>
             </li>

         </ul>

         {{-- <div class="sidebar-cta">
             <div class="sidebar-cta-content">
                 <strong class="mb-2 d-inline-block">Upgrade to Pro</strong>
                 <div class="mb-3 text-sm">
                     Are you looking for more components? Check out our premium version.
                 </div>
                 <div class="d-grid">
                     <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                 </div>
             </div>
         </div>
     </div> --}}
 </nav>
