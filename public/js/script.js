const toggler = document.querySelector(".btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

// input 2 form secara bersamaan pada halaman insert uji
// $(document).ready(function(){
//     $("#insertButton").click(function(){
//         // Mengirim data dari form kendaraan
//         $.ajax({
//             type: "POST",
//             url: "/dashboard/kendaraan",
//             data: $("#formKendaraan").serialize(),
//             success: function(response){
//                 // Handle response
//                 console.log(response);
//             },
//             error: function(error){
//                 // Handle error
//                 console.log(error);
//             }
//         });

//         // Mengirim data dari form uji emisi
//         $.ajax({
//             type: "POST",
//             url: "/dashboard/ujiemisi",
//             data: $("#formUjiEmisi").serialize(),
//             success: function(response){
//                 // Handle response
//                 console.log(response);
//             },
//             error: function(error){
//                 // Handle error
//                 console.log(error);
//             }
//         });
//     });
// });
// fix bismillah submit 2 form sekaligus
// document.addEventListener('DOMContentLoaded', function() {
//     // Function to submit both forms
//     function submitBothForms() {
//         document.getElementById('formKendaraan').submit(); // Submit form Kendaraan
//         document.getElementById('formUjiEmisi').submit(); // Submit form Uji Emisi
//     }

//     // Add click event listener to the submit button
//     document.getElementById('submitBothForms').addEventListener('click', function() {
//         submitBothForms();
//     });
// // });
// document.getElementById("myBtn").addEventListener("click", displayDate);

// function displayDate() {
// //   document.getElementById("demo").innerHTML = Date();
//   console.log('clicked')
// }

// Get form and button elements
// const formKendaraan = document.getElementById('formKendaraan');
// const formUjiEmisi = document.getElementById('formUjiEmisi');
// const submitButton = document.getElementById('submitBothForms');

// // Add click event listener to button
// formKendaraan.addEventListener('click', () => {
//   // Programmatically submit both forms
//   console.log('clicked')
// //   formKendaraan.submit();
// //   formUjiEmisi.submit();
// });