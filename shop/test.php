<!DOCTYPE html>
<html>
<head>
  <title>CSS Modal</title>
  <style>
    /* Modal styles */
    .modal {
      display: none; /* Hide the modal by default */
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5); /* Overlay background color */
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <!-- Cancel Modal -->
  <div id="cancleModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h5 class="modal-title">Cancel Modal</h5>
      <p>Cancel modal content goes here...</p>
      <div class="row">
        <div><button type="button" class="btn" id="cancleModalCloseBtn">Close</button></div>
        <div><button type="button" class="btn btn-primary">Save changes</button></div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div id="confermModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h5 class="modal-title">Confirmation Modal</h5>
      <p>Confirmation modal content goes here...</p>
      <button type="button" class="btn" id="confermModalCloseBtn">Close</button>
      <div><button type="button" class="btn btn-primary">Save changes</button></div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Open Cancel Modal
      document.getElementById('openCancleModal').addEventListener('click', function() {
        document.getElementById('cancleModal').style.display = 'block';
      });

      // Close Cancel Modal
      var closeCancleModal = function() {
        document.getElementById('cancleModal').style.display = 'none';
      };

      document.getElementById('cancleModalCloseBtn').addEventListener('click', closeCancleModal);
      document.getElementsByClassName('close')[0].addEventListener('click', closeCancleModal);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Open Confirmation Modal
      document.getElementById('openConfermModal').addEventListener('click', function() {
        document.getElementById('confermModal').style.display = 'block';
      });

      // Close Confirmation Modal
      var closeConfermModal = function() {
        document.getElementById('confermModal').style.display = 'none';
      };

      document.getElementById('confermModalCloseBtn').addEventListener('click', closeConfermModal);
      document.getElementsByClassName('close')[1].addEventListener('click', closeConfermModal);
    });
  </script>

  <!-- Your other HTML code goes here -->

  <!-- Trigger the modals -->
  <button type="button" id="openCancleModal">Open Cancel Modal</button>
  <!-- <button type="button" id="openConfermModal">Open Confirmation Modal</button> -->
</body>
</html>
