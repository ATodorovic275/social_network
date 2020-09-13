<!DOCTYPE html>
<html lang="en">
@include('admin.fixed.head')
<body>
    <section id="container">
        @include('admin.fixed.header')  
        @include('admin.fixed.sidebar') 
        <section id="main-content">
            <section class="wrapper"> 
                @yield('content')
            </section>
        </section>
        @include('admin.fixed.script')  
    </section>
</body>

</html>