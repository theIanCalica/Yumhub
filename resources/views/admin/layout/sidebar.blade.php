<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2 mt-5">
                    <li>
                        <a href="{{ route('admin.home') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-yellow-400 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-yellow-400 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fi fi-rr-users-alt "></i>
                            <span class="ml-3" sidebar-toggle-item>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('managers') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-yellow-400 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fi fi-rr-boss"></i>
                            <span class="ml-3" sidebar-toggle-item>Managers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('riders') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-yellow-400 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fi fi-rr-motorcycle"></i>
                            <span class="ml-3" sidebar-toggle-item>Riders</span>
                        </a>
                    </li>
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                            aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                            <i class="fi fi-rr-restaurant"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Food</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-layouts" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('cuisines') }}"
                                    class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Cuisines</a>
                            </li>
                            <li>
                                <a href="{{ route('categories') }}"
                                    class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Category</a>
                            </li>
                            <li>
                                <a href=""
                                    class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Food
                                    List</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('articles') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                            <i
                                class="fi fi-rr-document w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                            <span class="ml-3" sidebar-toggle-item>Articles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                            <i
                                class="fi fi-rr-messages-question w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>

                            <span class="ml-3" sidebar-toggle-item>Inquiries</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
