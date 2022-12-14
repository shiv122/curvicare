import "./bootstrap";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Echo = new Echo({
  broadcaster: "pusher",
  key: "myKey",
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
});

window.axios.defaults.headers.common["X-Socket-Id"] = window.Echo.socketId();

const channel = window.Echo.private(`private.chat.${window.me}`);
console.log(channel);
channel.listen(".message", (e) => {
  console.log(e);
});
