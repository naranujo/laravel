<header>
    <nav>
        <ul class='bg-primary d-flex justify-content-between align-items-center text-white text-center p-3 list-unstyled'>
            <!-- si $loggedIN devuelve true entonces -->
            <?php if ($loggedIn && $role === 'editor') { ?>
                <section class='l-side d-flex justify-content-between align-items-center'>
                    <li class='mr-5'><a href="{{ route('home', ['lang' => $lang]) }}" class='text-white
                    '>{{ $homeLabel }}</a></li>
                    <li class='mr-5'><a href="{{ route('view.add_post', ['lang' => $lang]) }}" class='text-white
                    '>{{ $newPostLabel }}</a></li>
                </section>
                <section class='r-side d-flex justify-content-between align-items-center'>
                    <li class='ml-5 text-secondary'>{{ $greetings }}</li>
                    <li class='ml-5'><a href="{{ route('view.profile', ['lang' => $lang]) }}" class='text-white
                    '>{{ $profileLabel }}</a></li>
                    <li class='ml-5'>
                        <form method="POST" action="{{ route('submit.logout') }}" style="margin:0;padding:0;box-sizing:border-box;">
                            @csrf
                            <button type="submit" style="background-color:transparent; border:0; color:white; align-self:center;">{{ $logoutLabel }}</button>
                        </form>
                    </li>
                </section>
            <?php } elseif ($loggedIn && $role === 'admin') { ?>
                <section class='l-side d-flex justify-content-between align-items-center'>
                    <li class='mr-5'><a href="{{ route('home', ['lang' => $lang]) }}" class='text-white'>{{ $homeLabel }}</a></li>
                    <li class='mr-5'><a href="{{ route('view.add_post', ['lang' => $lang]) }}" class='text-white'>{{ $newPostLabel }}</a></li>
                    <li class='mr-5'><a href="{{ route('view.admin.users', ['lang' => $lang]) }}" class='text-white'>{{ $usersAdminLabel }}</a></li>
                </section>
                <section class='r-side d-flex justify-content-between align-items-center'>
                    <li class='ml-5 text-secondary'>{{ $greetings }}</li>
                    <li class='ml-5'><a href="{{ route('view.profile', ['lang' => $lang]) }}" class='text-white'>{{ $profileLabel }}</a></li>
                    <li class='ml-5'>
                        <form method="POST" action="{{ route('submit.logout') }}" style="margin:0;padding:0;box-sizing:border-box;">
                            @csrf
                            <button type="submit" style="background-color:transparent; border:0; color:white; align-self:center;">{{ $logoutLabel }}</button>
                        </form>
                    </li>
                </section>
            <?php } elseif ($loggedIn && $role === 'user') { ?>
                <section class='l-side d-flex justify-content-between align-items-center'>
                    <li class='mr-5'><a href="{{ route('home', ['lang' => $lang]) }}" class='text-white
                    '>{{ $homeLabel }}</a></li>
                </section>
                <section class='r-side d-flex justify-content-between align-items-center'>
                    <li class='ml-5 text-secondary'>{{ $greetings }}</li>
                    <li class='ml-5'><a href="{{ route('view.profile', ['lang' => $lang]) }}" class='text-white
                    '>{{ $profileLabel }}</a></li>
                    <li class='ml-5'>
                        <form method="POST" action="{{ route('submit.logout') }}" style="margin:0;padding:0;box-sizing:border-box;">
                            @csrf
                            <button type="submit" style="background-color:transparent; border:0; color:white; align-self:center;">{{ $logoutLabel }}</button>
                        </form>
                    </li>
                </section>
            <?php } else { ?>
                <li><a href='' class='text-white'></a></li>
                <li><a href='/?lang={{ $lang }}' class='text-white'>{{ $back }}</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
