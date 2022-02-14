<div
    style="
    text-align: center;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    "
>
    <div
        style="
                background: linear-gradient(45deg, rgb(255, 0, 0), rgb(252, 124, 73));
                margin-right: 10%;
                margin-left: 10%;
                margin-bottom: 30px;
                padding-top: 20px;
                padding-bottom: 20px;
                color: white;
                letter-spacing: 0.3ch;
                border: 4px solid rgb(185, 66, 29);
                position: relative;

            "
    >
    <h3>¡Hola {{ $user->name ?? 'Enrique Iglesias'}}! </h3>
    <img src="https://worknow-cursos.com/img/Personaje.png" alt="" width="150px">
        <h1>¡Tenemos una promocion para vos!</h1>
        <div
            style="background: #737373;
            height: 100%;
            position: absolute;
            width: 100%;
            top: 10;
            left: 10;
            z-index: -1;
                    "
        ></div>
    </div>
    <div
        style="
                background: linear-gradient(45deg, rgb(255, 0, 0), rgb(255, 136, 89));
                margin-right: 10%;
                margin-left: 10%;
                margin-bottom: 30px;
                padding: 20px;
                padding-bottom: 20px;
                color: white;
                letter-spacing: 0.3ch;
                border: 4px solid rgb(185, 66, 29);
                position: relative;
                font-weight: bold;
            "
    >

        <h2 style="color:black">
            Presionando 
            <a href="https://wa.me/5492236772444?text=Hola%20te%20habla%20{{$user->name ?? "nombre alumno"}}%20quiero%20inscribirme%20con%20el%20descuento%20del%2015%%20,%20con%20el%20codigo%20{{'WN-'.$user->id.'-15'}}"
                style="color:rgb(132, 253, 132);font-size: 20px;"
                >
                AQUI</a>
            podras contactarte directamente por whatsapp y adquirir los cursos de:
        </h2>
            <div style="text-align: center;">
                @if ($user ?? false)
                    
                    @if (count($user->courses) != 0)
                    
                        @foreach ($user->courses as $course)
                        <h3 style="margin-right: 10px;">{{$course->nombre}}</h3>
                        @endforeach
                    @endif
                @endif
            </div>
            <h2 style="color:black;">

                con un descuento del 15% utilizando el codigo {{'WN-'.$user->id.'-15'}}
            </h2>
        

        <div
            style="background: #737373;
            height: 100%;
            position: absolute;
            width: 100%;
            top: 10;
            left: 10;
            z-index: -1;
                    "
        ></div>
    </div>
    
    <div
        style="
            background: rgb(250, 79, 0);
            padding: 15px;
            color:aliceblue;
            letter-spacing: 0.3ch;
        "
    >

        
        <h2>Beneficios de estudiar a distancia con Work Now</h2>
        <hr style="margin-top: 20px; margin-bottom: 40px;">
        <div style="margin: auto;display: flex;
        flex-wrap: wrap;"
        >
            <div
                style="min-width: 200px;
                margin-right: 20px;
                min-width: 200px;
                margin-bottom: 50px;
                "
            >
                <div
                    style="padding: 10px;
                    display: inline-block;
                    
                    background-color:  rgb(247, 131, 85);
                    position: relative;
                    color:black;
                    -webkit-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                    -moz-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                    box-shadow: 3px 3px 3px 3px rgba(156,156,156,1);
                    "
                >

                    <p>

                        Te da la posibilidad de poder capacitarte y trabajar al mismo tiempo sin necesidad de moverte de 
                        tu casa.
                    </p>
                    <div
                        style="position: absolute; width: 50px; top: -30;"
                    >
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M503.401,228.884l-43.253-39.411V58.79c0-8.315-6.741-15.057-15.057-15.057H340.976c-8.315,0-15.057,6.741-15.057,15.057
                                        v8.374l-52.236-47.597c-10.083-9.189-25.288-9.188-35.367-0.001L8.598,228.885c-8.076,7.36-10.745,18.7-6.799,28.889
                                        c3.947,10.189,13.557,16.772,24.484,16.772h36.689v209.721c0,8.315,6.741,15.057,15.057,15.057h125.913
                                        c8.315,0,15.057-6.741,15.057-15.057V356.931H293v127.337c0,8.315,6.741,15.057,15.057,15.057h125.908
                                        c8.315,0,15.057-6.741,15.056-15.057V274.547h36.697c10.926,0,20.537-6.584,24.484-16.772
                                        C514.147,247.585,511.479,236.245,503.401,228.884z M433.965,244.433c-8.315,0-15.057,6.741-15.057,15.057v209.721h-95.793
                                        V341.874c0-8.315-6.742-15.057-15.057-15.057H203.942c-8.315,0-15.057,6.741-15.057,15.057v127.337h-95.8V259.49
                                        c0-8.315-6.741-15.057-15.057-15.057H36.245l219.756-200.24l74.836,68.191c4.408,4.016,10.771,5.051,16.224,2.644
                                        c5.454-2.41,8.973-7.812,8.973-13.774V73.847h74.002v122.276c0,4.237,1.784,8.276,4.916,11.13l40.803,37.18H433.965z"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div
                style="min-width: 200px;
                margin-right: 20px;
                margin-bottom: 50px;
                "
            >
                <div
                    style="padding: 10px;
                    display: inline-block;
                    background-color:  rgb(247, 131, 85);
                    position: relative;
                    color:black;
                    -webkit-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                    -moz-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                    box-shadow: 3px 3px 3px 3px rgba(156,156,156,1);
                    "
                >

                    <p>

                        Tenes 100% del control de tu tiempo de estudio, cuanto mas le dediques antes terminaras.
                    </p>
                    <div
                        style="position: absolute; width: 55px; top: -30;"
                    >
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <path d="M272.015,448c97.202,0,176-78.798,176-176s-78.798-176-176-176s-176,78.798-176,176
                                    C96.125,369.156,174.858,447.89,272.015,448z M136.015,264h-23.592c4.17-81.933,69.659-147.422,151.592-151.592V136
                                    c0,4.418,3.582,8,8,8s8-3.582,8-8v-23.592c81.933,4.17,147.422,69.659,151.592,151.592h-31.592c-4.418,0-8,3.582-8,8s3.582,8,8,8
                                    h31.592c-4.17,81.932-69.659,147.422-151.592,151.592V408c0-4.418-3.582-8-8-8s-8,3.582-8,8v23.592
                                    c-81.932-4.17-147.422-69.659-151.592-151.592h23.592c4.418,0,8-3.582,8-8S140.433,264,136.015,264z"/>
                                <path d="M452.135,168.138c-2.385-4.132-4.912-8.18-7.576-12.138l19.752-19.752c3.123-3.124,3.123-8.188,0-11.312l-45.2-45.2
                                    c-3.124-3.123-8.188-3.123-11.312,0l-19.784,19.72c-32.002-21.606-69.414-33.819-108-35.256V16h56c4.418,0,8-3.582,8-8
                                    s-3.582-8-8-8h-128c-4.418,0-8,3.582-8,8s3.582,8,8,8h56v48.272c-71.348,2.724-136.3,41.894-172,103.728h-44
                                    c-4.418,0-8,3.582-8,8s3.582,8,8,8h48c0.208,0,0.384-0.104,0.592-0.12c2.883,0.037,5.557-1.495,6.984-4
                                    c50.899-93.024,167.571-127.174,260.596-76.276S491.36,271.176,440.462,364.2c-50.899,93.024-167.571,127.174-260.596,76.276
                                    c-32.192-17.614-58.662-44.084-76.276-76.276c-1.413-2.515-4.083-4.063-6.968-4.04c-0.208,0-0.392-0.12-0.608-0.12h-48
                                    c-4.418,0-8,3.582-8,8s3.582,8,8,8h44c57.411,99.444,184.567,133.52,284.011,76.109
                                    C475.47,394.738,509.545,267.582,452.135,168.138z M401.088,109.07l12.366-12.366l33.888,33.888l-12.384,12.384
                                    C424.998,130.42,413.634,119.044,401.088,109.07z"/>
                                <path d="M80.015,272c0-4.418-3.582-8-8-8h-64c-4.418,0-8,3.582-8,8s3.582,8,8,8h64C76.433,280,80.015,276.418,80.015,272z"/>
                                <path d="M24.015,232h56c4.418,0,8-3.582,8-8s-3.582-8-8-8h-56c-4.418,0-8,3.582-8,8S19.596,232,24.015,232z"/>
                                <path d="M88.015,320c0-4.418-3.582-8-8-8h-56c-4.418,0-8,3.582-8,8s3.582,8,8,8h56C84.433,328,88.015,324.418,88.015,320z"/>
                                <path d="M250.359,325.656c3.124,3.123,8.188,3.123,11.312,0l111.2-111.2c3.07-3.178,2.982-8.242-0.196-11.312
                                    c-3.1-2.994-8.015-2.994-11.116,0L256.015,308.688l-47.6-47.6c-3.178-3.069-8.243-2.982-11.312,0.196
                                    c-2.994,3.1-2.994,8.015,0,11.116L250.359,325.656z"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div
                style="min-width: 200px;
                margin-right: 20px;
                margin-bottom: 50px;
                "
            >
                <div
                style="padding: 10px;
                display: inline-block;
                background-color:  rgb(247, 131, 85);
                position: relative;
                color:black;
                -webkit-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                -moz-box-shadow: 6px 5px 2px 2px rgba(156,156,156,1);
                box-shadow: 3px 3px 3px 3px rgba(156,156,156,1);
                "
                >

                    <p>

                        Linea de atencion via wpp con tus profesores para que puedas despejar todas tus dudas.
                    </p>
                    <div
                        style="position: absolute; width: 80px; top: -30;"
                    >
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g id="XMLID_468_">
                                <path id="XMLID_469_" d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156
                                c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687
                                c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887
                                c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153
                                c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348
                                c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802
                                c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922
                                c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0
                                c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458
                                C233.168,179.508,230.845,178.393,227.904,176.981z"/>
                            <path id="XMLID_470_" d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716
                                c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396
                                c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z
                                M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188
                                l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677
                                c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867
                                C276.546,215.678,222.799,268.994,156.734,268.994z"/>                    </g>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>