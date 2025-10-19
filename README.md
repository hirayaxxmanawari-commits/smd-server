# PHP WebSocket Server with Ratchet

A real-time WebSocket server built with PHP and Ratchet, featuring a beautiful chat interface for testing.

## Features

- **Real-time Communication**: Full-duplex WebSocket communication
- **Multi-client Support**: Handle multiple simultaneous connections
- **JSON Message Protocol**: Structured message handling with type-based routing
- **Beautiful UI**: Modern, responsive chat interface for testing
- **Connection Management**: Automatic client tracking and status updates
- **Error Handling**: Robust error handling and connection recovery

## Requirements

- PHP 7.4 or higher
- Composer
- WebSocket-capable browser

## Installation

1. **Clone or download this project**

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Start the WebSocket server**:
   ```bash
   php server.php
   ```
   
   Or use the composer script:
   ```bash
   composer start
   ```

4. **Open the test page**:
   - Navigate to `public/index.html` in your browser
   - Or serve it with a local web server:
     ```bash
     php -S localhost:8000 -t public
     ```
     Then visit `http://localhost:8000`

## Usage

### Starting the Server

The WebSocket server runs on port 8080 by default. You can modify the port in `server.php`:

```php
$server = IoServer::factory(
    new HttpServer(
        new WsServer($handler)
    ),
    8080  // Change this port number
);
```

### Testing the WebSocket

1. Start the server: `php server.php`
2. Open `public/index.html` in multiple browser tabs/windows
3. Type messages and see them appear in real-time across all connected clients

### Message Types

The server handles different message types:

- **welcome**: Sent when a client connects
- **user_joined**: Broadcast when a new user joins
- **user_left**: Broadcast when a user disconnects
- **message**: Regular chat messages

### JSON Message Format

```json
{
    "type": "message",
    "message": "Hello, world!",
    "user": "User_abc123",
    "timestamp": "2024-01-01 12:00:00",
    "clients": 3
}
```

## Project Structure

```
php-ws/
├── composer.json          # Dependencies and autoloading
├── server.php            # Main server entry point
├── src/
│   └── WebSocketHandler.php  # WebSocket message handler
├── public/
│   └── index.html        # Test chat interface
└── README.md             # This file
```

## Customization

### Adding New Message Types

1. Modify `WebSocketHandler.php` to handle new message types
2. Update the client-side JavaScript in `index.html` to send/receive new types

### Extending Functionality

The `WebSocketHandler` class implements Ratchet's `MessageComponentInterface` with these methods:

- `onOpen()`: Called when a client connects
- `onMessage()`: Called when a message is received
- `onClose()`: Called when a client disconnects
- `onError()`: Called when an error occurs

### Database Integration

To persist messages or user data, you can:

1. Add database connection in the constructor
2. Store messages in `onMessage()`
3. Track user sessions in `onOpen()` and `onClose()`

## Troubleshooting

### Common Issues

1. **Port already in use**: Change the port number in `server.php`
2. **Connection refused**: Ensure the server is running before opening the test page
3. **CORS issues**: The WebSocket connection should work locally without CORS problems

### Debug Mode

Enable debug output by modifying the server:

```php
// In server.php, add before $server->run():
$server->loop->addPeriodicTimer(5, function() {
    echo "Server is running...\n";
});
```

## Security Considerations

This is a basic implementation. For production use, consider:

- Authentication and authorization
- Input validation and sanitization
- Rate limiting
- SSL/TLS encryption (WSS)
- Message size limits
- User session management

## License

This project is open source and available under the MIT License.

## Contributing

Feel free to submit issues and enhancement requests! 