@extends('layouts.users')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Spin Wheel</title>
    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        
        body {
          
          display: grid;
          place-items: center;
          
        }
        
        #spin_the_wheel {
          display: inline-block;
          position: relative;
          overflow: hidden;
          margin-top:40px;
        }
        
        #wheel {
          display: block;
        }
        
        #spin {
          font-size:15px;
          user-select: none;
          cursor: pointer;
          display: flex;
          justify-content: center;
          align-items: center;
          position: absolute;
          top: 50%;
          left: 50%;
          width: 30%;
          height: 30%;
          margin: -15%;
          background: #fff;
          color: #fff;
          box-shadow:
            0 0 0 8px currentColor,
            0 0px 15px 5px rgba(0, 0, 0, 0.6);
          border-radius: 50%;
          transition: 0.8s;
        }
        
        #spin::after {
          content: "";
          position: absolute;
          top: -17px;
          border: 10px solid transparent;
          border-bottom-color: currentColor;
          border-top: none;
        }
        
        .row {
          display: flex;
          flex-direction: row;
          flex-wrap: wrap;
          width: 100%;
          font-size:15px;
        }
        
        .column {
          display: flex;
          flex-direction: column;
          flex-basis: 100%;
          flex: 1;
          font-size:15px;
        }
        .bal-box{
            width:300px;
            height:40px;
            background:#FF5A10;
            border-radius:10px;
            margin-top: 30px;
        }
        .bal-box>ul{
            list-style:none;
            line-height:40px;
            display: flex;
            justify-content: space-between;
            color:white;
        }
        .bal-box>ul>li{
            display:inline-block;
            padding:0px 10px;
            font-size:12px;
        }
        .bal-box>ul>li>span{
            padding:1px 10px;
            border-radius:10px;
            background:black;
        }
        .rules-box{
            width:300px;
            height:200px;
            background:#FF5A10;
            border-radius:10px;
            margin-top: 20px;
            padding:20px 10px;
            margin-bottom:40px;
        }
        .rules-box>h2{
            font-size:13px;
            margin-bottom:7px;
            text-transform:uppercase;
        }
        .rules-box>ol>li{
            font-size:12px;
            color:white;
            padding:7px 0px;
        }
    </style>

    <body class="">
        <div id="app" data-v-app="">
            <div data-v-0ee0ae8d="" class="withdrawPage bg_00">
               
                
                
                <div id="spin_the_wheel">
                  <canvas id="wheel" width="300" height="300"></canvas>
                  <div id="spin">SPIN</div>
                </div>
                
                <div class="bal-box">
                    <ul>
                        <li>Balance <span>{{ number_format(auth()->user()->bonus_balance, 2) }}</span></li>
                        <li>Spin <span>{{ auth()->user()->spin }}</span></li>
                    </ul>
                </div>
                
                <div class="rules-box">
                    <h2>Spin Wheel Instructions </h2>
                    <ol>
                        <li>1. Invite 1 member you get 1 Spin chance. </li>
                        <li>2. Invite 5 members you get 5 Spin chances.</li>
                        <li>3. Invite 15 members you get 15 Spin chances.</li>
                    </ol>
                    
                </div>
                
                
            </div>
        </div>
        
        <script src="{{ asset('js/toast.js') }}"></script>
        <script>
            const sectors = [
                { color: "#FFBC03", text: "#030303", label: "R1", percentage: 12.5 },
                { color: "#FF5A10", text: "#030303", label: "R2", percentage: 12.5 },
                { color: "#FFBC03", text: "#030303", label: "R3", percentage: 12.5 },
                { color: "#FF5A10", text: "#030303", label: "R1", percentage: 12.5 },
                { color: "#FFBC03", text: "#030303", label: "R5", percentage: 12.5 },
                { color: "#FF5A10", text: "#030303", label: "R1", percentage: 12.5 },
                { color: "#FFBC03", text: "#030303", label: "R0", percentage: 12.5 },
                { color: "#FF5A10", text: "#030303", label: "R4", percentage: 12.5 },
            ];
            
            const events = {
                listeners: {},
                addListener(eventName, fn) {
                    this.listeners[eventName] = this.listeners[eventName] || [];
                    this.listeners[eventName].push(fn);
                },
                fire(eventName, ...args) {
                    if (this.listeners[eventName]) {
                        for (let fn of this.listeners[eventName]) {
                            fn(...args);
                        }
                    }
                },
            };
            
            const rand = (m, M) => Math.random() * (M - m) + m;
            const spinEl = document.querySelector("#spin");
            const ctx = document.querySelector("#wheel").getContext("2d");
            const dia = ctx.canvas.width;
            const rad = dia / 2;
            const PI = Math.PI;
            const TAU = 2 * PI;
            
            const friction = 0.991; // Friction value
            let angVel = 0; // Angular velocity
            let ang = 0; // Current angle
            
            let spinButtonClicked = false;
            
            const totalPercentage = sectors.reduce((sum, sector) => sum + sector.percentage, 0);
            if (totalPercentage !== 100) {
                throw new Error("Total sector percentages must equal 100.");
            }
            
            const angles = sectors.map((sector) => (sector.percentage / 100) * TAU);
            
            function drawSector(sector, i) {
                const startAngle = angles.slice(0, i).reduce((sum, angle) => sum + angle, 0);
                const endAngle = startAngle + angles[i];
            
                ctx.beginPath();
                ctx.fillStyle = sector.color;
                ctx.moveTo(rad, rad);
                ctx.arc(rad, rad, rad, startAngle, endAngle);
                ctx.lineTo(rad, rad);
                ctx.fill();
            
                ctx.save();
                ctx.translate(rad, rad);
                ctx.rotate(startAngle + angles[i] / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = sector.text;
                ctx.font = "30px ";
                ctx.fillText(sector.label, rad - 20, 10);
                ctx.restore();
            }
            
            function getIndex() {
                const normalizedAngle = (TAU - (ang % TAU)) % TAU;
                let cumulativeAngle = 0;
                for (let i = 0; i < angles.length; i++) {
                    cumulativeAngle += angles[i];
                    if (normalizedAngle < cumulativeAngle) {
                        return i;
                    }
                }
                return 0;
            }
            
            function rotate() {
                const sector = sectors[getIndex()];
                ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`;
            
                spinEl.textContent = !angVel ? "SPIN" : sector.label;
                spinEl.style.background = sector.color;
                spinEl.style.color = sector.text;
            }
            
            function frame() {
                if (!angVel && spinButtonClicked) {
                    const finalSector = sectors[getIndex()];
                    events.fire("spinEnd", finalSector);
                    spinButtonClicked = false;
                    return;
                }
            
                angVel *= friction;
                if (angVel < 0.002) angVel = 0;
                ang += angVel;
                ang %= TAU;
                rotate();
            }
            
            function engine() {
                frame();
                requestAnimationFrame(engine);
            }
            
            function checkSpinAvailability() {
                return fetch('/user/check-spin', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (!data.canSpin) {
                            message('You have no spins left!');
                            return false;
                        }
                        return true;
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        message('Failed to check spin availability.');
                        return false;
                    });
            }
            
            function init() {
                sectors.forEach(drawSector);
                rotate();
                engine();
            
                spinEl.addEventListener("click", async () => {
                    if (angVel) return; // Prevent multiple spins
            
                    const canSpin = await checkSpinAvailability();
                    if (!canSpin) return;
            
                    angVel = rand(0.25, 0.45); // Random velocity for spinning
                    spinButtonClicked = true;
                });
            }
            
            init();
            
            events.addListener("spinEnd", (sector) => {
                console.log(`Congratulations! You won: ${sector.label}`);
                
                fetch('/user/spin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ result: sector.label }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            message(`Congratulations! You won: ${sector.label}`);
                            location.reload()
                        } else {
                            message('An error occurred!');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        message('Failed to process the spin.');
                    });
            });


        </script>

    

    {{--<script>
        const sectors = [
            { color: "#FFBC03", text: "#030303", label: "R1", percentage: 12.5 },
            { color: "#FF5A10", text: "#030303", label: "Lost", percentage: 12.5 },
            { color: "#FFBC03", text: "#030303", label: "R3", percentage: 12.5 },
            { color: "#FF5A10", text: "#030303", label: "R4", percentage: 12.5 },
            { color: "#FFBC03", text: "#030303", label: "R5", percentage: 12.5 },
            { color: "#FF5A10", text: "#030303", label: "R8", percentage: 12.5 },
            { color: "#FFBC03", text: "#030303", label: "+5 Spin", percentage: 12.5 },
            { color: "#FF5A10", text: "#030303", label: "R20", percentage: 12.5 },
        ];
    
        const events = {
            listeners: {},
            addListener(eventName, fn) {
                this.listeners[eventName] = this.listeners[eventName] || [];
                this.listeners[eventName].push(fn);
            },
            fire(eventName, ...args) {
                if (this.listeners[eventName]) {
                    for (let fn of this.listeners[eventName]) {
                        fn(...args);
                    }
                }
            },
        };
    
        const rand = (m, M) => Math.random() * (M - m) + m;
        const spinEl = document.querySelector("#spin");
        const ctx = document.querySelector("#wheel").getContext("2d");
        const dia = ctx.canvas.width;
        const rad = dia / 2;
        const PI = Math.PI;
        const TAU = 2 * PI;
    
        const friction = 0.991; // Friction value
        let angVel = 0; // Angular velocity
        let ang = 0; // Current angle
    
        let spinButtonClicked = false;
    
        // Calculate angles based on percentages
        const totalPercentage = sectors.reduce((sum, sector) => sum + sector.percentage, 0);
        if (totalPercentage !== 100) {
            throw new Error("Total sector percentages must equal 100.");
        }
    
        const angles = sectors.map((sector) => (sector.percentage / 100) * TAU);
    
        function drawSector(sector, i) {
            const startAngle = angles.slice(0, i).reduce((sum, angle) => sum + angle, 0);
            const endAngle = startAngle + angles[i];
    
            // Draw sector
            ctx.beginPath();
            ctx.fillStyle = sector.color;
            ctx.moveTo(rad, rad);
            ctx.arc(rad, rad, rad, startAngle, endAngle);
            ctx.lineTo(rad, rad);
            ctx.fill();
    
            // Add text
            ctx.save();
            ctx.translate(rad, rad);
            ctx.rotate(startAngle + (angles[i] / 2));
            ctx.textAlign = "right";
            ctx.fillStyle = sector.text;
            ctx.font = "30px";
            ctx.fillText(sector.label, rad - 20, 10);
            ctx.restore();
        }
    
        function getIndex() {
            const normalizedAngle = (TAU - (ang % TAU)) % TAU; // Normalize for clockwise
            let cumulativeAngle = 0;
            for (let i = 0; i < angles.length; i++) {
                cumulativeAngle += angles[i];
                if (normalizedAngle < cumulativeAngle) {
                    return i;
                }
            }
            return 0; // Fallback to first sector
        }
    
        function rotate() {
            const sector = sectors[getIndex()];
            ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`;
    
            spinEl.textContent = !angVel ? "SPIN" : sector.label;
            spinEl.style.background = sector.color;
            spinEl.style.color = sector.text;
        }
    
        function frame() {
            if (!angVel && spinButtonClicked) {
                const finalSector = sectors[getIndex()];
                events.fire("spinEnd", finalSector);
                spinButtonClicked = false;
                return;
            }
    
            angVel *= friction; // Apply friction
            if (angVel < 0.002) angVel = 0; // Stop when velocity is very low
            ang += angVel; // Update angle
            ang %= TAU; // Normalize angle
            rotate();
        }
    
        function engine() {
            frame();
            requestAnimationFrame(engine);
        }
    
        function init() {
            sectors.forEach(drawSector);
            rotate();
            engine();
            spinEl.addEventListener("click", () => {
                if (!angVel) angVel = rand(0.25, 0.45); // Random velocity for spinning
                spinButtonClicked = true;
            });
        }
    
        init();
    
        events.addListener("spinEnd", (sector) => {
            console.log(`Congratulations! You won: ${sector.label}`);
        });
    </script>--}}


       
    </body>

    @include('templates.basic.partials.footer')
@endsection