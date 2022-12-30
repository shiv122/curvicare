const { default: axios } = require("axios");
const moment = require("moment");
require("./bootstrap");

// const channel = window.Echo.join(`test-channel`);

// channel
//   .subscribed((e) => {
//     console.log("Subscribed to chat channel", channel);
//   })
//   .here((users) => {
//     users.forEach((user) => {
//       console.log(user);
//     });
//   })
//   .joining((user) => {
//     console.log(user.name + " joined");
//   })
//   .leaving((user) => {
//     console.log(user.name + " left");
//   })
//   .listenForWhisper("typing", (e) => {
//     console.log(e);
//   })
//   .listen(".call-event", (e) => {
//     console.log(e.message);
//   });

window.Echo.private("user-channel." + window.me.id).listen(
  ".notification",
  (e) => {
    console.log(e);
  }
);
