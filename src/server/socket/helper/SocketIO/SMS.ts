import { Server, Socket as __Socket__ } from 'socket.io';
export namespace SMS {
  export function Listen(io: Server) {
    io.on('sendSuccess', (result) => {
      console.log(result);
    });
  }
  export function Emit(io: Server, data: any, nameEvent: string) {
    io.emit(nameEvent, data);
  }
}
