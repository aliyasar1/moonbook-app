</main>
<!-- Footer-->
<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; MoonBook 2022</div></div>
            <div class="col-auto">
                <a class="link-light small" target="_blank" href="{{ route('kvkk') }}">KVKK Aydınlatma Metni</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="#">Terms</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="#">Contact</a>
            </div>
        </div>
    </div>
</footer>

@yield('js')

<script src="{{ asset('js/notify.js') }}"></script>

</body>

</html>
