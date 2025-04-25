// Scripts for firebase and firebase messaging
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {
  apiKey: "AIzaSyC0JZr8g9nOtEFhSS3-tYupuaIxN5SdWVs",
  authDomain: "web-push-notifications-f1cf1.firebaseapp.com",
  projectId: "web-push-notifications-f1cf1",
  storageBucket: "web-push-notifications-f1cf1.appspot.com",
  messagingSenderId: "381496875115",
  appId: "1:381496875115:web:db384171b17aa6ace2792e",
  measurementId: "G-0C1KZ6RRXZ"
};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log('Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});