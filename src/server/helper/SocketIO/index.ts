import { Server } from 'socket.io';

const InitializeServerSocket = (io: Server) => {
  io.on('connection', (socket) => {
    socket.emit('hello', '+840896359374, Verify Code: 583478');
    socket.on('asjkdhsjkad', (arg) => {
      console.log(arg);
    });
  });
};

// const send2SystemSMS = (socket: Socket, data: any) => {
//   socket.emit('sendData', data);
// };

export default InitializeServerSocket;
