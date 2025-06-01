<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chat - Psylography</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --psylo-green: #93BF00;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
            overflow: hidden;
        }
        .navbar-brand {
            color: var(--psylo-green);
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: black !important;
            margin-right: 20px;
        }
        .profile-circle {
            width: 40px;
            height: 40px;
            background-color: var(--psylo-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-user:hover {
            background-color: #FFF4DE;
        }
        .chat-header {
            background-color: var(--psylo-green);
            height: 64px;
        }
        .message.sent {
            background-color: #FDE1A5;
            align-self: end;
        }
        .message.received {
            background-color: #D3D3D3;
            align-self: start;
        }
        .chat-input button {
            color: var(--psylo-green);
        }
        #contextMenu {
            position: absolute;
            z-index: 10000;
            width: 120px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.2);
            display: none;
            border-radius: 4px;
        }
        #contextMenu ul {
            list-style: none;
            padding: 5px 0;
            margin: 0;
        }
        #contextMenu ul li {
            padding: 8px 15px;
            cursor: pointer;
        }
        #contextMenu ul li:hover {
            background-color: var(--psylo-green);
            color: white;
        }
        .edit-input {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px 8px;
        }
        .chat-header-custom {
            background-color: #FFC857;
            height: 64px;
            color: black;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom px-4">
    <div class="container-fluid">
        <a href="{{ route('views.Homepage') }}">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo" style="height: 40px;">
        </a>
        <div class="d-flex align-items-center ms-auto">
            <a class="nav-link" href="#">Journal</a>
            <a class="nav-link" href="#">Appointment</a>
            <a class="nav-link" href="#">Blog</a>
            <a class="nav-link" href="#">Chat</a>
            <div class="profile-circle ms-3">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>
</nav>

<!-- Main Chat Layout -->
<div class="container-fluid">
    <div class="d-flex" style="height: calc(100vh - 64px); width: 100vw;">
        <!-- Sidebar -->
        <div class="bg-white overflow-auto" style="width: 25%; min-width: 250px;">
            <div class="p-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search..." />
            </div>

            @foreach($users as $user)
                @php $isActive = $receiverType === 'user' && $receiverId == $user->id; @endphp
                <a href="{{ route('chat.index', ['receiverType' => 'user', 'receiverId' => $user->id]) }}"
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 chat-user {{ $isActive ? 'active' : '' }}"
                   style="{{ $isActive ? 'background-color: #FFF4DE;' : '' }}"
                   data-name="{{ strtolower($user->fullname) }}">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-2"
                         style="width: 32px; height: 32px; background-color: #5C8D00;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="fw-semibold">{{ $user->fullname }}</div>
                </a>
            @endforeach

            @foreach($psychs as $psych)
                @php $isActive = $receiverType === 'psych' && $receiverId == $psych->id; @endphp
                <a href="{{ route('chat.index', ['receiverType' => 'psych', 'receiverId' => $psych->id]) }}"
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 chat-user {{ $isActive ? 'active' : '' }}"
                   style="{{ $isActive ? 'background-color: #FFF4DE;' : '' }}"
                   data-name="{{ strtolower($psych->full_name) }}">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-2"
                         style="width: 32px; height: 32px; background-color: #93BF00;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="fw-semibold" style="color: var(--psylo-green);">{{ $psych->full_name }}</div>
                </a>
            @endforeach
        </div>

        <!-- Chat Panel -->
        <div class="flex-grow-1 d-flex flex-column bg-white">
            @if($receiverType && $receiverId)
                <div class="d-flex align-items-center p-3 chat-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; background-color: #93BF00;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="fw-bold text-black">
                            {{ $receiverType === 'psych' ? $psychs->firstWhere('id', $receiverId)->full_name : $users->firstWhere('id', $receiverId)->fullname }}
                        </div>
                    </div>
                </div>

                <div class="flex-grow-1 overflow-auto p-3 d-flex flex-column" id="chatMessages">
                    @foreach ($chats as $chat)
                        <div 
                            class="message {{ ($chat->sender_id == Auth::guard('user')->id() && $chat->sender_type === 'user') ? 'sent align-self-end' : 'received align-self-start' }} rounded px-3 py-2 mb-2"
                            data-chat-id="{{ $chat->id }}"
                            data-message="{{ htmlspecialchars($chat->message, ENT_QUOTES) }}"
                            oncontextmenu="showContextMenu(event, {{ $chat->id }})"
                        >
                            <span class="message-text">{{ $chat->message }}</span>

                            @if($chat->sender_id == Auth::guard('user')->id() && $chat->sender_type === 'user')
                                <form method="POST" action="{{ route('chat.update', $chat->id) }}" class="edit-form d-none mt-2" onsubmit="return submitEdit(event, {{ $chat->id }})">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="message" class="edit-input" value="{{ $chat->message }}" required />
                                    <button type="submit" class="btn btn-sm btn-success mt-1 me-1">Save</button>
                                    <button type="button" class="btn btn-sm btn-secondary mt-1" onclick="cancelEdit({{ $chat->id }})">Cancel</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('chat.send') }}" class="d-flex align-items-center border-top p-3">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiverId }}" />
                    <input type="hidden" name="receiver_type" value="{{ $receiverType }}" />
                    <input type="text" name="message" class="form-control me-2" placeholder="Send a message..." required />
                    <button type="submit" class="btn"><i class="fas fa-paper-plane fs-4"></i></button>
                </form>
            @else
                <div class="d-flex flex-grow-1 align-items-center justify-content-center text-secondary fs-4">
                    Select a contact to start chatting.
                </div>
            @endif
        </div>
    </div>
</div>

<div id="contextMenu">
    <ul>
        <li id="editOption">Edit</li>
        <li id="deleteOption">Delete</li>
    </ul>
</div>

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contextMenu = document.getElementById('contextMenu');
        let currentChatId = null;

        document.getElementById('searchInput').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const users = document.querySelectorAll('.chat-user');

            users.forEach(user => {
                const name = user.getAttribute('data-name');
                if (name.includes(filter)) {
                    user.style.display = '';
                } else {
                    user.style.display = 'none';
                }
            });
        });

        window.addEventListener('click', () => {
            contextMenu.style.display = 'none';
        });

        document.getElementById('deleteOption').addEventListener('click', () => {
            if (!currentChatId) return;
            if (confirm('Are you sure you want to delete this message?')) {
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/chat/${currentChatId}`;
                deleteForm.submit();
            }
        });

        document.getElementById('editOption').addEventListener('click', () => {
            if (!currentChatId) return;
            const messageDiv = document.querySelector(`[data-chat-id="${currentChatId}"]`);
            if (!messageDiv) return;

            const messageText = messageDiv.querySelector('.message-text');
            const editForm = messageDiv.querySelector('.edit-form');

            messageText.style.display = 'none';
            editForm.classList.remove('d-none');
            contextMenu.style.display = 'none';
        });
    });

    function showContextMenu(event, chatId) {
        event.preventDefault();
        const contextMenu = document.getElementById('contextMenu');

        // Check if the chat message belongs to the logged in user before showing menu
        const messageDiv = event.currentTarget;
        const userId = "{{ Auth::guard('user')->id() }}";
        const senderId = messageDiv.getAttribute('data-chat-id');

        // For this example, only show if the message is sent by the logged-in user
        if (!messageDiv.classList.contains('sent')) {
            return;
        }

        currentChatId = chatId;

        contextMenu.style.top = event.pageY + 'px';
        contextMenu.style.left = event.pageX + 'px';
        contextMenu.style.display = 'block';
    }

    function cancelEdit(chatId) {
        const messageDiv = document.querySelector(`[data-chat-id="${chatId}"]`);
        const messageText = messageDiv.querySelector('.message-text');
        const editForm = messageDiv.querySelector('.edit-form');

        editForm.classList.add('d-none');
        messageText.style.display = '';
    }

    async function submitEdit(event, chatId) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new URLSearchParams(formData),
            });

            if (response.ok) {
                const data = await response.json();
                if (data.success) {
                    const messageDiv = document.querySelector(`[data-chat-id="${chatId}"]`);
                    messageDiv.querySelector('.message-text').textContent = formData.get('message');
                    cancelEdit(chatId);
                } else {
                    alert('Failed to update message.');
                }
            } else {
                alert('Failed to update message.');
            }
        } catch (error) {
            alert('Failed to update message.');
        }
    }
</script>

</body>
</html>
