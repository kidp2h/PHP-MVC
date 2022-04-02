import http from 'http';
import { Server } from 'socket.io';
import { SMS } from './helper/SocketIO/SMS';

type PhoneNumber = {
  phoneNumber: string;
};
function getReqData(req: http.IncomingMessage) {
  return new Promise<string>((resolve, reject) => {
    try {
      let body = '';
      // listen to data sent by client
      req.on('data', (chunk) => {
        // append the string version to the body
        body += chunk.toString();
      });
      // listen till the end
      req.on('end', () => {
        // send back the data
        resolve(body);
      });
    } catch (error) {
      reject(error);
    }
  });
}

const server = http.createServer(async (req, res) => {
  if (req.url == '/emitMessage' && req.method == 'POST') {
    res.writeHead(200, { 'Content-Type': 'application/json' });
    let body: string = await getReqData(req);
    let result = JSON.parse(body);
    SMS.Emit(io, result, 'emitMessage');
    res.end();
  }
});
const io = new Server(server);
io.on('connection', (socket) => {
  socket.on('sendSuccess', (arg) => {
    console.log(arg);
  });
});
server.listen(5000, () => {
  console.log('Started on port: 5000');
});

export { server, io };
