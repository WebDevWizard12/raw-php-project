<form action="" method="POST" id="registrationForm">
    <table>
        <tr>
            <td>First Name</td>
            <td>
                <input type="text" id="firstName">
                <span id="fnError"></span>
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" id="lastName"><span id="InError" style="color: red;"></span></td>
        </tr>
        <tr>
            <td>Email Address</td>
            <td><input type="email" id="emailAddress"><span id="eaError"></span></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" id="password"><span id="paError"></span></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" id="confirmPassword"><span id="cpError" style="color: red;"></span></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <input type="radio" id="male" name="gender" value="male"> Male
                <input type="radio" id="female" name="gender" value="female"> Female
                <span id="geError" style="color: red;"></span>
            </td>
        </tr>
        <tr>
            <td>Skills</td>
            <td>
                <input type="checkbox" id="html" name="html" value="html"> HTML
                <input type="checkbox" id="css" name="css" value="css"> CSS
                <input type="checkbox" id="javascript" name="javascript" value="javascript"> JAVASCRIPT
                <input type="checkbox" id="php" name="php" value="php"> PHP
                <span id="skError" style="color: red;"></span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btn" value="SUBMIT"></td>
        </tr>
    </table>
</form>

<script src="jquery-3.7.1.js"></script>
<script src="script.js"></script>