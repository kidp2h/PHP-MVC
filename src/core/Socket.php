<?php
namespace core;

class __Socket__ {
  private string $host;
  private int $port;
  private \Socket $socket;
  private bool $flag;
  private \Socket $client;

  public function __construct() {
    $this->host = "192.168.99.1";
	  $this->port = 2604;
	
	// No Timeout 
	set_time_limit(0);

	//Create Socket
	$this->socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

	//Bind the socket to port and host
	$result = socket_bind($this->socket, $this->host, $this->port) or die("Could not bind to socket\n");

	while(true) {
		//Start listening to the port
		$result = socket_listen($this->socket, 3) or die("Could not set up socket listener\n");

		//Make it to accept incoming connection
		$spawn = socket_accept($this->socket) or die("Could not accept incoming connection\n");

		//Read the message from the client socket
		$input = socket_read($spawn, 1024) or die("Could not read input\n");

		$output = 'I received your message. Now do you job and subscribe to Mossymoo youtube channel!';

		//Send message back to client socket
		socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
    echo $output;
	}

	socket_close($spawn);
	socket_close($this->socket);
  }

  public function handshake($client, $headers, $socket) {
    if (preg_match("/Sec-WebSocket-Version: (.*)\r\n/", $headers, $match))
      $version = $match[1];
    else {
      print("The client doesn't support WebSocket");
      return false;
    }

    if ($version == 13) {
      // Extract header variables
      if (preg_match("/GET (.*) HTTP/", $headers, $match))
        $root = $match[1];
      if (preg_match("/Host: (.*)\r\n/", $headers, $match))
        $host = $match[1];
      if (preg_match("/Origin: (.*)\r\n/", $headers, $match))
        $origin = $match[1];
      if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $headers, $match))
        $key = $match[1];
      $acceptKey = $key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
      $acceptKey = base64_encode(sha1($acceptKey, true));
      $upgrade = "HTTP/1.1 101 Switching Protocols\r\n".
        "Upgrade: websocket\r\n".
        "Connection: Upgrade\r\n".
        "Sec-WebSocket-Accept: $acceptKey".
        "\r\n\r\n";
      socket_write($client, $upgrade);
      return true;
    } else {
      print("WebSocket version 13 required (the client supports version {$version})");
      return false;
    }
  }

  public function unmask($payload) {
    $length = ord($payload[1]) & 127;

    if ($length == 126) {
      $masks = substr($payload, 4, 4);
      $data = substr($payload, 8);
    }
    elseif($length == 127) {
      $masks = substr($payload, 10, 4);
      $data = substr($payload, 14);
    }
    else {
      $masks = substr($payload, 2, 4);
      $data = substr($payload, 6);
    }

    $text = '';
    for ($i = 0; $i < strlen($data); ++$i) {
      $text .= $data[$i] ^ $masks[$i % 4];
    }
    return $text;
  }

  public function encode($text) {
    // 0x1 text frame (FIN + opcode)
    $b1 = 0x80 | (0x1 & 0x0f);
    $length = strlen($text);
    if ($length <= 125)
      $header = pack('CC', $b1, $length);
    elseif($length > 125 && $length < 65536) $header = pack('CCS', $b1, 126, $length);
    elseif($length >= 65536)
    $header = pack('CCN', $b1, 127, $length);
    return $header.$text;
  }
}