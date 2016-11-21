/**
 * Created by ekrem on 19.11.2016.
 */
var bird = {
        xPos : 60,
        yPos : 0,
        velocity : 0,
        frame : 0,
        rotation : 0,
        gravity : 0.25,
        jumpPower : 4.6,

    jump: function() {
        this.velocity = -this.jumpPower;

    },

    update: function() {
        /* Hovering the bird in the menu screen */
        if(currentState == states.Menu){
            this.yPos = height - 280 + 5*Math.cos(frames/10);
            this.rotation = 0;
        }
        else {
            this.velocity += this.gravity;
            this.yPos += this.velocity;
            /* Stopping the bird movement */
            if(this.yPos >= height - floorImage.height - 20){
                this.yPos = height - floorImage.height - 20;
                if(currentState === states.Game) {
                    currentState = states.FinalScreen;
                }
                this.velocity = this.jumpPower;
            }
        }

    },

    draw: function(ctx) {
        ctx.save();
        ctx.translate(this.xPos, this.yPos);
        ctx.rotate(this.rotation);

        birdImage.draw(ctx, birdImage.width / 2, birdImage.height / 2);
        ctx.restore();
    }
};