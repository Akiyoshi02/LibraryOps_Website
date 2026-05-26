<?php include('layouts/header.php');?>

<?php 

if (!isset($_SESSION["user_email"]))
{
    header('Location: sign_in.php');
}
?>

<main>
    <div class="aboutus">
        <div class="about">
            <h1>The Goodreads Author Program</h1><br>
            <u><h2>BECOME A GOODREADS AUTHOR</h2></u><br>
            <p>Any author, anywhere in the world, can join the LibraryOps Author Program for free. All you need is an Internet connection and a published book (or a soon-to-be published book) that can be found in our database. The LibraryOps Author Program allows published authors to claim their profile page to promote their book and engage with readers. Once verified, your author profile will include the official LibraryOps Author badge, which you can use to tell your fans to follow you on LibraryOps.</p><br><br>
            <h1>Benefits of Claiming Your Profile Page</h1><br>
            <u><h2>MANAGE YOUR PROFILE</h2></u><br>
            <p>Update your profile picture, write your bio, and fix your book listings—by joining the LibraryOps Author Program you’re able to keep the information about yourself up-to-date.</p><br>
            <u><h2>PROMOTE YOUR BOOKS</h2></u><br>
            <p>Run a giveaway, connect your blog, advertise your books—the LibraryOps Author Program gives you access to the marketing tools you need to build buzz around your books.</p>
        </div>
    </div>
</main>

<?php include('layouts/footer.php');?>
