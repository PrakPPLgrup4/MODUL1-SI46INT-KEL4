<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chat - Psylography</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
            overflow: hidden;
        }
        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100vw;
        }
        .navbar .active {
            color: #F7B733 !important;
            border-bottom: 2px solid #F7B733;
            padding-bottom: 2px;
        }
        .chat-user:hover {
            background-color: #FFF4DE;
        }
        .chat-header {
            background-color: #F7B733;
        }
        .message.sent {
            background-color: #FDE1A5;
            align-self: end;
            position: relative;
        }
        .message.received {
            background-color: #D3D3D3;
            align-self: start;
            position: relative;
        }
        .chat-input button {
            color: rgb(143, 180, 9);
        }
        /* Context Menu Styling */
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
            background-color: #F7B733;
            color: white;
        }
        /* Edit input */
        .edit-input {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px 8px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
    <a class="navbar-brand fw-bold text-success" href="#">PSYLOGRAPHY</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link fw-semibold" href="#">Journaling</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold" href="#">Appointment</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold" href="#">Blog</a></li>
            <li class="nav-item"><a class="nav-link active fw-semibold" href="#">Chat</a></li>
            <li class="nav-item">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fas fa-user"></i>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="d-flex" style="height: calc(100vh - 64px); width: 100vw;">
        <div class="bg-white overflow-auto" style="width: 25%; min-width: 250px;">
            <div class="border-bottom p-3 fw-bold">Chat</div>
            <div class="p-3">
                <input type="text" class="form-control" placeholder="Search..." />
            </div>

            @foreach($users as $user)
                <a href="{{ route('chat.index', ['receiverType' => 'user', 'receiverId' => $user->id]) }}" class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 chat-user">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="fw-semibold">{{ $user->fullname }}</div>
                </a>
            @endforeach

            @foreach($psychs as $psych)
                <a href="{{ route('chat.index', ['receiverType' => 'psych', 'receiverId' => $psych->id]) }}" class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 chat-user">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="fw-semibold text-success">{{ $psych->full_name }}</div>
                </a>
            @endforeach
        </div>

        <div class="flex-grow-1 d-flex flex-column bg-white">
            @if($receiverType && $receiverId)
                <div class="d-flex align-items-center p-3 gap-2 chat-header text-white fw-bold">
                    <div class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        {{ $receiverType === 'psych' ? $psychs->firstWhere('id', $receiverId)->full_name : $users->firstWhere('id', $receiverId)->fullname }}
                    </div>
                </div>

                <div class="flex-grow-1 overflow-auto p-3 d-flex flex-column" id="chatMessages">
                    @foreach ($chats as $chat)
                        <div 
                            class="message {{ $chat->sender_id == Auth::id() ? 'sent align-self-end' : 'received align-self-start' }} rounded px-3 py-2 mb-2" 
                            data-chat-id="{{ $chat->id }}" 
                            data-message="{{ htmlspecialchars($chat->message, ENT_QUOTES) }}"
                            oncontextmenu="showContextMenu(event, {{ $chat->id }})"
                        >
                            <span class="message-text">{{ $chat->message }}</span>

                            @if($chat->sender_id == Auth::id() && $chat->sender_type == (Auth::user() instanceof \App\Models\User ? 'user' : 'psych'))
                                <!-- Hidden edit form (toggle on edit) -->
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

<!-- Custom Context Menu -->
<div id="contextMenu">
    <ul>
        <li id="editOption">Edit</li>
        <li id="deleteOption">Delete</li>
    </ul>
</div>

<!-- Hidden delete form to submit on delete -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    let contextMenu = document.getElementById('contextMenu');
    let currentChatId = null;

    // Show custom context menu
    function showContextMenu(event, chatId) {
        event.preventDefault();

        // Only show menu for messages sent by current user
        const messageDiv = event.currentTarget;
        const senderId = {{ Auth::id() }};
        const senderType = "{{ Auth::user() instanceof \App\Models\User ? 'user' : 'psych' }}";

        // Check if this message belongs to current user (we trust blade so no extra checks here)

        currentChatId = chatId;

        // Position the menu
        contextMenu.style.top = event.pageY + 'px';
        contextMenu.style.left = event.pageX + 'px';
        contextMenu.style.display = 'block';

        return false;
    }

    // Hide context menu on click outside
    window.addEventListener('click', () => {
        contextMenu.style.display = 'none';
    });

    // Handle Delete
    document.getElementById('deleteOption').addEventListener('click', () => {
        if (!currentChatId) return;

        if (confirm('Are you sure you want to delete this message?')) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/chat/${currentChatId}`;
            deleteForm.submit();
        }
    });

    // Handle Edit
    document.getElementById('editOption').addEventListener('click', () => {
        if (!currentChatId) return;

        // Find the message div
        const msgDiv = document.querySelector(`.message[data-chat-id="${currentChatId}"]`);
        if (!msgDiv) return;

        // Hide the message text
        msgDiv.querySelector('.message-text').style.display = 'none';

        // Show the edit form
        const form = msgDiv.querySelector('.edit-form');
        if (form) {
            form.classList.remove('d-none');
        }

        contextMenu.style.display = 'none';
    });

    // Cancel edit
    function cancelEdit(chatId) {
        const msgDiv = document.querySelector(`.message[data-chat-id="${chatId}"]`);
        if (!msgDiv) return;

        // Show message text
        msgDiv.querySelector('.message-text').style.display = 'inline';

        // Hide edit form
        const form = msgDiv.querySelector('.edit-form');
        if (form) {
            form.classList.add('d-none');
        }
    }

    // Optional: AJAX submit for edit form to avoid full reload (simple fallback)
    function submitEdit(event, chatId) {
        event.preventDefault();

        const form = event.target;
        const input = form.querySelector('input[name="message"]');
        const newMessage = input.value.trim();

        if (!newMessage) {
            alert('Message cannot be empty.');
            return false;
        }

        // You can do an AJAX request here if you want, but for simplicity, just submit normally:
        form.submit();

        // Or after success, update UI accordingly.
        return false;
    }

    // Disable native context menu except on messages
    document.body.addEventListener('contextmenu', (e) => {
        if (!e.target.closest('.message')) {
            contextMenu.style.display = 'none';
        }
    });
</script>

</body>
</html>