// Import the functions you need from the SDKs you need
    import { initializeApp } from "firebase/app";
    // import { getAnalytics } from "firebase/analytics";
    import { getAuth } from "firebase/auth";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
      apiKey: "AIzaSyA31fRvgYCFx_q6zxntEFo8vCZl0JQsTyE",
      authDomain: "fir-project-test-b9927.firebaseapp.com",
      projectId: "fir-project-test-b9927",
      storageBucket: "fir-project-test-b9927.appspot.com",
      messagingSenderId: "801323063179",
      appId: "1:801323063179:web:f37aeb6ddcf3d02984018e",
      measurementId: "G-KKR2M7CYKP"
    };

    // Initialize Firebase
    const firebaseApp = initializeApp(firebaseConfig);
    // const analytics = getAnalytics(firebaseApp);
    export const firebaseAuth = getAuth(firebaseApp);
    export default firebaseApp