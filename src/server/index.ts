import http from 'http';
import { Server } from 'socket.io';
import InitializeServerSocket from './helper/SocketIO';

const server = http.createServer(async (req, res) => {
  if (req.url == '/emitMessage' && req.method == 'POST') {
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.write('...');
    res.end();
  }
  if (req.url == '/' && req.method == 'GET') {
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.write('index');
    res.end();
  }
});
const io = new Server(server);
InitializeServerSocket(io);
server.listen(5000, () => {
  console.log('Started on port: 5000');
});

export default server;
