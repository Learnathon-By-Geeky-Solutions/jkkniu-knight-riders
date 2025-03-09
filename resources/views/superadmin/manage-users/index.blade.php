<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SuperAdmin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __($who . ' List') }}</h3>
                    </div>
                    @session('success')
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endsession
                    <!-- Search Input -->
                    <div class="mb-4">
                        <input type="text" id="searchInput" placeholder="Search by name or email..."
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <!-- Users Table -->
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th scope="col" class="px-4 py-2">ID</th>
                                <th scope="col" class="px-4 py-2">Name</th>
                                <th scope="col" class="px-4 py-2">Email</th>
                                <th scope="col" class="px-4 py-2">Role</th>
                                <th scope="col" class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->role }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('superadmin.manage-users.edit', $user->id) }}"
                                            class="d-inline px-2 py-1 text-green-700 hover:bg-green-500 hover:text-white rounded">Edit</a>
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('superadmin.manage-users.delete', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirmDelete({{ $user->id }})"
                                                class="px-2 py-1 text-red-500 hover:bg-red-500 hover:text-white rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center">No {{ strtolower($who) }} found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add JavaScript for Search Functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
