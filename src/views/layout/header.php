<?php require_once __DIR__ . '/head.php'; ?>

<nav class="navbar bg-gray-800 sticky top-0 inset-x-0 border-b border-gray-700 z-10">
    <div class="container py-3 px-6 xl:px-0 flex items-center justify-between">
        <a href="/">
            <div class="logo">
                <p>Moviezz</p>
            </div>
        </a>
        <div id="searchForm" class="search-form absolute top-0 left-0 w-full -mt-16 py-2 px-3 bg-gray-800 border-b border-gray-700 lg:border-none lg:relative lg:max-w-2xl lg:p-0 lg:m-0 transition duration-150 ease-in-out">
            <form action="/search/index" method="GET" autocomplete="off" class="container px-3 text-gray-500 flex items-center justify-start border-2 border-gray-700 bg-gray-700 rounded focus-within:bg-gray-800 overflow-hidden transition duration-200 ease-in-out md:relative">
                <div class="mr-3 text-xl text-gray-600">
                    <i class="fas fa-search"></i>
                </div>
                <input type="search" name="query" id="searchInput" placeholder="Search..." value="<?= $_GET['query'] ?>" class="py-2 bg-transparent w-full focus:outline-none appearance-none leading-normal" />
            </form>
            <div class="search_suggestions hidden absolute inset-x-0 rounded-b bg-gray-800 shadow-lg transition duration-150 ease-in-out">
                <div class="suggestions p-3 transition duration-150 ease-in-out"></div>
                <div class="genres p-3 border-t border-gray-700"></div>
            </div>
        </div>
        <div class="actions flex items-center justify-start">
            <button id="searchToggle" class="mr-5 btn btn-text lg:hidden"><i class="fas fa-search"></i></button>
            <?php if (!$user) : ?>
                <a href="/user/login" class="btn btn-primary">LOGIN OR SIGNUP</a>
            <?php else : ?>
                <button id="modalToggle" class="mr-5 btn btn-primary"><i class="fas fa-plus"></i></button>
                <div class="relative">
                    <div id="avatar" class="avatar h-10 w-10 rounded-full cursor-pointer overflow-hidden">
                        <img src="/images/users/<?= $user['avatar'] ?>" alt="<?= $user['name'] ?>" class="h-full">
                    </div>
                    <div id="profileMenu" class="mt-12 w-32 bg-gray-800 border border-gray-700 rounded absolute top-0 right-0 hidden">
                        <a href="/user/edit/<?= $user['username'] ?>" class="p-2 block w-full hover:bg-gray-700">Profile</a>
                        <a href="/user/logout" class="p-2 block w-full hover:bg-gray-700">Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php if ($user) : ?>
    <div id="modal" class="modal hidden absolute inset-0 flex items-center justify-center z-20 overflow-auto">
        <div class="absolute bg-gray-800 w-full md:w-auto md:rounded-lg shadow-xl md:overflow-hidden">
            <div class="head p-3 sticky top-0 inset-x-0 bg-gray-800 border-b border-gray-700 flex items-center justify-between">
                <p class="text-xl font-medium">Add movie</p>
                <button id="modalClose" class="h-8 w-8 rounded-full hover:bg-gray-700 focus:outline-none"><i class="fas fa-times"></i></button>
            </div>
            <div class="form">
                <form id="movieForm" action="/movie/add" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="md:flex items-start">
                        <div class="flex-1 my-5 md:mx-5 md:my-0">
                            <div class="mx-auto h-56 w-64 rounded overflow-hidden">
                                <img src="/images/preview.png" alt="Cover image preview" class="h-full">
                            </div>
                            <label for="coverPhoto" class="mt-5 btn btn-neutral">
                                <span>Upload thumbnail</span>
                                <input type="file" name="thumbnail" id="coverPhoto" onchange="previewImage(event)" required hidden>
                            </label>
                        </div>
                        <div class="flex-1 my-5 md:mx-5 md:my-0">
                            <input type="text" name="name" placeholder="Name" class="mb-5 input" required>
                            <select name="genre" id="genre" class="mb-5 input" required>
                                <option value="null">Select category</option>
                                <option value="action">Action</option>
                                <option value="comedy">Comedy</option>
                                <option value="animation">Animation</option>
                                <option value="thriller">Thriller</option>
                                <option value="documentary">Documentary</option>
                            </select>
                            <input type="number" name="price" min="0" max="500" placeholder="Price" class="mb-5 input" required>
                            <textarea name="description" id="description" class="mb-5 input" placeholder="Description" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full btn btn-primary">Add movie</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- ---Container start--- -->
<div class="container p-3">

    <?php if (isset($_SESSION['fb']) && !empty($_SESSION['fb'])) : ?>
        <div id="feedback" class="fb mb-3 p-3 text-center text-gray-500 rounded bg-gray-700">
            <p><i class="fas fa-info-circle"></i> <span><?= $_SESSION['fb'] ?></span></p>
            <?php unset($_SESSION['fb']); ?>
        </div>
    <?php endif; ?>