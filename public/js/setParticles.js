$(function () {
    particlesJS(
        "particles_blog", //アニメーションを表示する要素(id)を指定する。同名のclassが存在する場合は動作しない
        {
            particles: {
                number: {
                    value: 6,
                    density: {
                        enable: true,
                        value_area: 800,
                    },
                },
                color: {
                    value: ["#f2e6ff", "#c7e6fa", "#f9e5ef"],
                },
                shape: {
                    type: "polygon",
                    stroke: {
                        width: 0,
                        color: "#000",
                    },
                    polygon: {
                        nb_sides: 7,
                    },
                    image: {
                        src: "img/github.svg",
                        width: 100,
                        height: 100,
                    },
                },
                opacity: {
                    value: 0.4,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false,
                    },
                },
                size: {
                    value: 160,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 10,
                        size_min: 50.348787162683394,
                        sync: false,
                    },
                },
                line_linked: {
                    enable: false,
                    distance: 200,
                    color: "#ffffff",
                    opacity: 1,
                    width: 2,
                },
                move: {
                    enable: true,
                    speed: 8,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200,
                    },
                },
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: false,
                        mode: "grab",
                    },
                    onclick: {
                        enable: false,
                        mode: "push",
                    },
                    resize: true,
                },
                modes: {
                    grab: {
                        distance: 400,
                        line_linked: {
                            opacity: 1,
                        },
                    },
                    bubble: {
                        distance: 400,
                        size: 40,
                        duration: 2,
                        opacity: 8,
                        speed: 3,
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4,
                    },
                    push: {
                        particles_nb: 4,
                    },
                    remove: {
                        particles_nb: 2,
                    },
                },
            },
            retina_detect: true,
        }
    );
});
