<!DOCTYPE html>
<html lang="en">
<head>
    <!-- css file here -->
    <?= $this->include('Includes/Library') ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"><!--begin::App Wrapper-->
<div class="app-wrapper"> 
    <!-- header file here -->  
    <?= $this->include('Includes/Header') ?>
    <!-- sidebar file here -->
    <?= $this->include('Includes/Sidebar.php') ?>  
    <!-- dynmic main content -->
    <?= $this->renderSection('content') ?>   
    <!-- footer file here -->
    <?= $this->include('Includes/Footer') ?>
</div> 
<!-- js file here --> 
<?= $this->include('Includes/Js') ?>
<!-- dyanmic js appear here -->
<?= $this->renderSection('js') ?>
</body>
</html>

