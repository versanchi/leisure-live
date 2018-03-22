<?php 
/*if (isset($_COOKIE['vcookie']) && ($_COOKIE['vcookie']== "code")) {
                                                                                                  
} else {
    header("location: http://tour.panoramawebsys.com/security.php");
    exit;
}*/
?>
<?php                                        
/*if (isset($_COOKIE['mycookie']) && ($_COOKIE['mycookie']== "LBD")) { */?>  
<html>
<head>
<META NAME="Title" CONTENT="LTM operation">
<META NAME="Author" CONTENT="Ferry Budiono">
<META NAME="Copyright" CONTENT="�2012 - Ferry Budiono">
<META NAME="Designer" CONTENT="versanchi">
<META NAME="Publisher" CONTENT="Panorama Tours Indonesia">
<title>Welcome to LTM site - Administration Page</title>
<link type="text/css" href="../config/style000.css" rel="stylesheet"/>  
<link href="../config/frontstyle.css" rel="stylesheet" type="text/css" />
<link href="../config/loginstyle.css" rel="stylesheet" type="text/css" />
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>-->
<script src="../config/jquery.min-ver1.4.2.js"></script>
<script src="../config/login.js"></script>
<style>
        * { margin: 0; padding: 0; }

        html {
            background: url(../admin/images/backgrounds.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body {
            background: transparent;
            margin: 0;
        }

        canvas {
            cursor: crosshair;
            display: block;
        }
</style>
<script>                       
    function delete_cookie(name) {
      document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    }
    var cookie_name = 'pop';
    delete_cookie(cookie_name);
</script>
</head>
<body onLoad="document.myform.username.focus();" >

<div id="header">
  <div id="content_head">
    <!--<h2>Login</h2><center>
    <img src="images/login-welcome.gif" width="97" height="105" hspace="10" align="center">
    <img src="images/santaclaus.png" width="97" height="105" hspace="10" align="left"> -->
    <center>
    <div id="bar">
        <div id="container">
            <!-- Login Starts Here -->
            <div id="loginContainer">
                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                <div style="clear:both"></div>
                <div id="loginBox">
                    <form id="loginForm" method="POST" action="cek_login.php">
                        <fieldset id="body">
                            <fieldset>
                                <label for="email">Employee ID</label>
                                <input type="text" name="username" id="email" />
                            </fieldset>
                            <fieldset>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" />
                            </fieldset>
                            <input type="submit" id="login" value="Login" />
                            <a href="forgot.php">Forgot Password</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- Login Ends Here -->
        </div>

    </div>
   <!-- <table>
        <tr style="border: hidden;">
          <td style="border: hidden;">
    <iframe style="height: 326px; width: auto;" title="Weather Forecast" src="http://www.wweather.info/weathergadget01/" frameborder="0" scrolling="no" width="320" height="300"></iframe>
    </td><td style="border: hidden;">
    <script type="text/javascript" src="http://cdn.widgetserver.com/syndication/subscriber/InsertWidget.js"></script><script type="text/javascript">if (WIDGETBOX) WIDGETBOX.renderWidget('50fd5066-8108-4039-a02b-ea18329b08fe');</script>
<noscript>Get the <a href="http://www.widgetbox.com/widget/travel-picture-of-the-day">Travel Picture of the day</a> widget and many other <a href="http://www.widgetbox.com/">great free widgets</a> at <a href="http://www.widgetbox.com">Widgetbox</a>! Not seeing a widget? (<a href="http://support.widgetbox.com/">More info</a>)</noscript>
    </td></table> -->
    <!--
    <br><br>
             <form method="POST" action="cek_login.php">
      <table>
        <tr style="border: hidden;">
          <td style="border: hidden;">Employee ID</td>
          <td>
            <input type="text" name="username"></td>
        </tr>
        <tr style="border: hidden;">
          <td>Password</td>
          <td style="border: hidden;">
            <input type="password" name="password"></td>
        </tr>
        <tr style="border: hidden;">
          <td colspan="2"><center><input type="submit" value="Login"></center></td>
        </tr>
      </table>
    </form>  </center> -->

  </div>
  <!--<div id="footer"> Copyright &copy; 2012 by INS Division, Panorama Tours Indonesia - Best Viewed in Mozilla Firefox (9.0.1) or Greater</div> -->
</div>
<canvas id="canvas">Canvas is not supported in your browser.</canvas>
<script>
// when animating on canvas, it is best to use requestAnimationFrame instead of setTimeout or setInterval
// not supported in all browsers though and sometimes needs a prefix, so we need a shim
window.requestAnimFrame = ( function() {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        function( callback ) {
            window.setTimeout( callback, 1000 / 60 );
        };
})();

// now we will setup our basic variables for the demo
var canvas = document.getElementById( 'canvas' ),
    ctx = canvas.getContext( '2d' ),
// full screen dimensions
    cw = window.innerWidth,
    ch = window.innerHeight,
// firework collection
    fireworks = [],
// particle collection
    particles = [],
// starting hue
    hue = 120,
// when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
    limiterTotal = 5,
    limiterTick = 0,
// this will time the auto launches of fireworks, one launch per 80 loop ticks
    timerTotal = 80,
    timerTick = 0,
    mousedown = false,
// mouse x coordinate,
    mx,
// mouse y coordinate
    my;

// set canvas dimensions
canvas.width = cw;
canvas.height = ch;

// now we are going to setup our function placeholders for the entire demo

// get a random number within a range
function random( min, max ) {
    return Math.random() * ( max - min ) + min;
}

// calculate the distance between two points
function calculateDistance( p1x, p1y, p2x, p2y ) {
    var xDistance = p1x - p2x,
        yDistance = p1y - p2y;
    return Math.sqrt( Math.pow( xDistance, 2 ) + Math.pow( yDistance, 2 ) );
}

// create firework
function Firework( sx, sy, tx, ty ) {
// actual coordinates
    this.x = sx;
    this.y = sy;
// starting coordinates
    this.sx = sx;
    this.sy = sy;
// target coordinates
    this.tx = tx;
    this.ty = ty;
// distance from starting point to target
    this.distanceToTarget = calculateDistance( sx, sy, tx, ty );
    this.distanceTraveled = 0;
// track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
    this.coordinates = [];
    this.coordinateCount = 3;
// populate initial coordinate collection with the current coordinates
    while( this.coordinateCount-- ) {
        this.coordinates.push( [ this.x, this.y ] );
    }
    this.angle = Math.atan2( ty - sy, tx - sx );
    this.speed = 2;
    this.acceleration = 1.05;
    this.brightness = random( 50, 70 );
// circle target indicator radius
    this.targetRadius = 1;
}

// update firework
Firework.prototype.update = function( index ) {
// remove last item in coordinates array
    this.coordinates.pop();
// add current coordinates to the start of the array
    this.coordinates.unshift( [ this.x, this.y ] );

// cycle the circle target indicator radius
    if( this.targetRadius < 8 ) {
        this.targetRadius += 0.3;
    } else {
        this.targetRadius = 1;
    }

// speed up the firework
    this.speed *= this.acceleration;

// get the current velocities based on angle and speed
    var vx = Math.cos( this.angle ) * this.speed,
        vy = Math.sin( this.angle ) * this.speed;
// how far will the firework have traveled with velocities applied?
    this.distanceTraveled = calculateDistance( this.sx, this.sy, this.x + vx, this.y + vy );

// if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
    if( this.distanceTraveled >= this.distanceToTarget ) {
        createParticles( this.tx, this.ty );
// remove the firework, use the index passed into the update function to determine which to remove
        fireworks.splice( index, 1 );
    } else {
// target not reached, keep traveling
        this.x += vx;
        this.y += vy;
    }
}

// draw firework
Firework.prototype.draw = function() {
    ctx.beginPath();
// move to the last tracked coordinate in the set, then draw a line to the current x and y
    ctx.moveTo( this.coordinates[ this.coordinates.length - 1][ 0 ], this.coordinates[ this.coordinates.length - 1][ 1 ] );
    ctx.lineTo( this.x, this.y );
    ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
    ctx.stroke();

    ctx.beginPath();
// draw the target for this firework with a pulsing circle
    ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
    ctx.stroke();
}

// create particle
function Particle( x, y ) {
    this.x = x;
    this.y = y;
// track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
    this.coordinates = [];
    this.coordinateCount = 5;
    while( this.coordinateCount-- ) {
        this.coordinates.push( [ this.x, this.y ] );
    }
// set a random angle in all possible directions, in radians
    this.angle = random( 0, Math.PI * 2 );
    this.speed = random( 1, 10 );
// friction will slow the particle down
    this.friction = 0.95;
// gravity will be applied and pull the particle down
    this.gravity = 1;
// set the hue to a random number +-50 of the overall hue variable
    this.hue = random( hue - 50, hue + 50 );
    this.brightness = random( 50, 80 );
    this.alpha = 1;
// set how fast the particle fades out
    this.decay = random( 0.015, 0.03 );
}

// update particle
Particle.prototype.update = function( index ) {
// remove last item in coordinates array
    this.coordinates.pop();
// add current coordinates to the start of the array
    this.coordinates.unshift( [ this.x, this.y ] );
// slow down the particle
    this.speed *= this.friction;
// apply velocity
    this.x += Math.cos( this.angle ) * this.speed;
    this.y += Math.sin( this.angle ) * this.speed + this.gravity;
// fade out the particle
    this.alpha -= this.decay;

// remove the particle once the alpha is low enough, based on the passed in index
    if( this.alpha <= this.decay ) {
        particles.splice( index, 1 );
    }
}

// draw particle
Particle.prototype.draw = function() {
    ctx. beginPath();
// move to the last tracked coordinates in the set, then draw a line to the current x and y
    ctx.moveTo( this.coordinates[ this.coordinates.length - 1 ][ 0 ], this.coordinates[ this.coordinates.length - 1 ][ 1 ] );
    ctx.lineTo( this.x, this.y );
    ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';
    ctx.stroke();
}

// create particle group/explosion
function createParticles( x, y ) {
// increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
    var particleCount = 30;
    while( particleCount-- ) {
        particles.push( new Particle( x, y ) );
    }
}

// main demo loop
function loop() {
// this function will run endlessly with requestAnimationFrame
    requestAnimFrame( loop );

// increase the hue to get different colored fireworks over time
//hue += 0.5;

// create random color
    hue= random(0, 360 );

// normally, clearRect() would be used to clear the canvas
// we want to create a trailing effect though
// setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
    ctx.globalCompositeOperation = 'destination-out';
// decrease the alpha property to create more prominent trails
    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
    ctx.fillRect( 0, 0, cw, ch );
// change the composite operation back to our main mode
// lighter creates bright highlight points as the fireworks and particles overlap each other
    ctx.globalCompositeOperation = 'lighter';

// loop over each firework, draw it, update it
    var i = fireworks.length;
    while( i-- ) {
        fireworks[ i ].draw();
        fireworks[ i ].update( i );
    }

// loop over each particle, draw it, update it
    var i = particles.length;
    while( i-- ) {
        particles[ i ].draw();
        particles[ i ].update( i );
    }

// launch fireworks automatically to random coordinates, when the mouse isn't down
    if( timerTick >= timerTotal ) {
        if( !mousedown ) {
// start the firework at the bottom middle of the screen, then set the random target coordinates, the random y coordinates will be set within the range of the top half of the screen
            fireworks.push( new Firework( cw / 2, ch, random( 0, cw ), random( 0, ch / 2 ) ) );
            timerTick = 0;
        }
    } else {
        timerTick++;
    }

// limit the rate at which fireworks get launched when mouse is down
    if( limiterTick >= limiterTotal ) {
        if( mousedown ) {
// start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
            fireworks.push( new Firework( cw / 2, ch, mx, my ) );
            limiterTick = 0;
        }
    } else {
        limiterTick++;
    }
}

// mouse event bindings
// update the mouse coordinates on mousemove
canvas.addEventListener( 'mousemove', function( e ) {
    mx = e.pageX - canvas.offsetLeft;
    my = e.pageY - canvas.offsetTop;
});

// toggle mousedown state and prevent canvas from being selected
canvas.addEventListener( 'mousedown', function( e ) {
    e.preventDefault();
    mousedown = true;
});

canvas.addEventListener( 'mouseup', function( e ) {
    e.preventDefault();
    mousedown = false;
});

// once the window loads, we are ready for some fireworks!
window.onload = loop;

</script>
</body>
</html>
<?php /*} else { <a href="//affiliates.mozilla.org/link/banner/26828"><img src="//affiliates.mozilla.org/media/uploads/banners/910443de740d4343fa874c37fc536bd89998c937.png" alt="Download: Fast, Fun, Awesome" /></a>
    header("location: http://tour.panorama-tours.com/security.php");
    exit;
}  */
?>