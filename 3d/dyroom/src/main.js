import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import { FilmPass } from 'three/examples/jsm/postprocessing/FilmPass.js';



// Scene
const scene = new THREE.Scene();
scene.background = new THREE.Color(0x000010); // Dark blue-black for starfield
scene.fog = new THREE.Fog(0x000010, 10, 50);

// Camera
const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.set(8, 4, 12); // Move camera further back

// Renderer with enhanced quality settings
const renderer = new THREE.WebGLRenderer({ 
    antialias: true,
    alpha: true,
    powerPreference: 'high-performance',
    stencil: false,
    depth: true
});
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // High DPI support
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFSoftShadowMap;
renderer.shadowMap.autoUpdate = true;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 2.5; // Maximum brightness exposure
renderer.outputColorSpace = THREE.SRGBColorSpace;
renderer.physicallyCorrectLights = true;
document.body.appendChild(renderer.domElement);

// Post-processing setup
const composer = new EffectComposer(renderer);
const renderPass = new RenderPass(scene, camera);
composer.addPass(renderPass);

// Bloom effect for dramatic lighting
const bloomPass = new UnrealBloomPass(
    new THREE.Vector2(window.innerWidth, window.innerHeight),
    0.4, // strength
    0.8, // radius
    0.1  // threshold
);
composer.addPass(bloomPass);

// Film grain effect for cinematic look (reduced intensity)
const filmPass = new FilmPass(0.1, 0.01, 648, false);
composer.addPass(filmPass);


// Maximum Ambient Light for ultra bright visibility
const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
scene.add(ambientLight);

// Additional super bright fill light
const fillLight = new THREE.AmbientLight(0xffdcb2, 1.2);
scene.add(fillLight);

// Extra white fill light
const extraFillLight = new THREE.AmbientLight(0xffffff, 0.8);
scene.add(extraFillLight);

// Flashlight (Spotlight yang mengikuti kamera)
const flashlight = new THREE.SpotLight(
    0xfff4d6, // Warna lebih putih/kuning
    2,        // Intensitas lebih tinggi
    30,       // Jarak
    Math.PI/6, // Angle lebih sempit (30 derajat)
    0.5,      // Penumbra
    1         // Decay
);
flashlight.castShadow = true;
flashlight.shadow.mapSize.width = 2048;
flashlight.shadow.mapSize.height = 2048;
flashlight.shadow.bias = -0.0001;
scene.add(flashlight);

// Helper untuk visualisasi spotlight (opsional)
// const helper = new THREE.SpotLightHelper(flashlight);
// scene.add(helper);

// Maximum brightness point lights for car illumination
const pointLight = new THREE.PointLight(0xffffff, 3.0);
pointLight.position.set(0, 3, 0);
scene.add(pointLight);

// Super bright point lights around the car
const pointLight1 = new THREE.PointLight(0xffffff, 2.5);
pointLight1.position.set(-4, 4, 3);
scene.add(pointLight1);

const pointLight2 = new THREE.PointLight(0xffffff, 2.5);
pointLight2.position.set(4, 4, 3);
scene.add(pointLight2);

const pointLight3 = new THREE.PointLight(0xffffff, 2.0);
pointLight3.position.set(-3, 3, -3);
scene.add(pointLight3);

const pointLight4 = new THREE.PointLight(0xffffff, 2.0);
pointLight4.position.set(3, 3, -3);
scene.add(pointLight4);

// Ultra bright front fill lights
const fillPointLight1 = new THREE.PointLight(0xffffff, 2.2);
fillPointLight1.position.set(-2, 2, 5);
scene.add(fillPointLight1);

const fillPointLight2 = new THREE.PointLight(0xffffff, 2.2);
fillPointLight2.position.set(2, 2, 5);
scene.add(fillPointLight2);

// Additional high-intensity point lights for extreme brightness
const extraLight1 = new THREE.PointLight(0xffffff, 1.8);
extraLight1.position.set(0, 6, 0);
scene.add(extraLight1);

const extraLight2 = new THREE.PointLight(0xffffff, 1.5);
extraLight2.position.set(-6, 3, 0);
scene.add(extraLight2);

const extraLight3 = new THREE.PointLight(0xffffff, 1.5);
extraLight3.position.set(6, 3, 0);
scene.add(extraLight3);

const extraLight4 = new THREE.PointLight(0xffffff, 1.3);
extraLight4.position.set(0, 3, 6);
scene.add(extraLight4);

// Ultra bright main spotlights targeting the car
const mainSpotlight1 = new THREE.SpotLight(0xffffff, 8, 30, Math.PI/12, 0.2, 1);
mainSpotlight1.position.set(-6, 8, 4);
mainSpotlight1.target.position.set(0, 0, 0);
mainSpotlight1.castShadow = true;
mainSpotlight1.shadow.mapSize.width = 2048;
mainSpotlight1.shadow.mapSize.height = 2048;
mainSpotlight1.shadow.bias = -0.0001;
scene.add(mainSpotlight1);
scene.add(mainSpotlight1.target);

const mainSpotlight2 = new THREE.SpotLight(0xffffff, 7.5, 30, Math.PI/12, 0.2, 1);
mainSpotlight2.position.set(6, 8, 4);
mainSpotlight2.target.position.set(0, 0, 0);
mainSpotlight2.castShadow = true;
mainSpotlight2.shadow.mapSize.width = 2048;
mainSpotlight2.shadow.mapSize.height = 2048;
mainSpotlight2.shadow.bias = -0.0001;
scene.add(mainSpotlight2);
scene.add(mainSpotlight2.target);

// Maximum brightness front spotlights for car illumination
const frontSpotlight1 = new THREE.SpotLight(0xffffff, 6.5, 25, Math.PI/10, 0.3, 1);
frontSpotlight1.position.set(-4, 6, 8);
frontSpotlight1.target.position.set(0, 0.5, 0);
frontSpotlight1.castShadow = true;
scene.add(frontSpotlight1);
scene.add(frontSpotlight1.target);

const frontSpotlight2 = new THREE.SpotLight(0xffffff, 6.5, 25, Math.PI/10, 0.3, 1);
frontSpotlight2.position.set(4, 6, 8);
frontSpotlight2.target.position.set(0, 0.5, 0);
frontSpotlight2.castShadow = true;
scene.add(frontSpotlight2);
scene.add(frontSpotlight2.target);

// Super bright top-down spotlight for overall illumination
const topSpotlight = new THREE.SpotLight(0xffffff, 7, 35, Math.PI/8, 0.4, 1);
topSpotlight.position.set(0, 12, 0);
topSpotlight.target.position.set(0, 0, 0);
topSpotlight.castShadow = true;
scene.add(topSpotlight);
scene.add(topSpotlight.target);

// Rim lighting spotlights for luxury effect
const rimLight1 = new THREE.SpotLight(0x4080ff, 2, 25, Math.PI/10, 0.3, 1);
rimLight1.position.set(-10, 5, -3);
rimLight1.target.position.set(0, 0.5, 0);
rimLight1.castShadow = true;
scene.add(rimLight1);
scene.add(rimLight1.target);

const rimLight2 = new THREE.SpotLight(0xff6040, 2, 25, Math.PI/10, 0.3, 1);
rimLight2.position.set(10, 5, -3);
rimLight2.target.position.set(0, 0.5, 0);
rimLight2.castShadow = true;
scene.add(rimLight2);
scene.add(rimLight2.target);

// Accent lighting from behind
const accentLight = new THREE.SpotLight(0xffd700, 1.5, 20, Math.PI/8, 0.4, 1);
accentLight.position.set(0, 6, -8);
accentLight.target.position.set(0, 1, 0);
accentLight.castShadow = true;
scene.add(accentLight);
scene.add(accentLight.target);

// Starfield effect
const starCount = 1000;
const starGeometry = new THREE.BufferGeometry();
const starPositions = new Float32Array(starCount * 3);
const starColors = new Float32Array(starCount * 3);
const starSizes = new Float32Array(starCount);

for (let i = 0; i < starCount; i++) {
    // Random positions in a large sphere around the scene
    const radius = 100 + Math.random() * 200;
    const theta = Math.random() * Math.PI * 2;
    const phi = Math.random() * Math.PI;
    
    starPositions[i * 3] = radius * Math.sin(phi) * Math.cos(theta);
    starPositions[i * 3 + 1] = radius * Math.cos(phi);
    starPositions[i * 3 + 2] = radius * Math.sin(phi) * Math.sin(theta);
    
    // Random star colors (white to slightly blue/yellow)
    const colorVariation = 0.8 + Math.random() * 0.2;
    starColors[i * 3] = colorVariation; // Red
    starColors[i * 3 + 1] = colorVariation; // Green
    starColors[i * 3 + 2] = 0.9 + Math.random() * 0.1; // Blue (slightly more blue)
    
    // Random star sizes
    starSizes[i] = Math.random() * 3 + 1;
}

starGeometry.setAttribute('position', new THREE.BufferAttribute(starPositions, 3));
starGeometry.setAttribute('color', new THREE.BufferAttribute(starColors, 3));
starGeometry.setAttribute('size', new THREE.BufferAttribute(starSizes, 1));

const starMaterial = new THREE.PointsMaterial({
    size: 2,
    sizeAttenuation: true,
    vertexColors: true,
    transparent: true,
    opacity: 0.8,
    blending: THREE.AdditiveBlending
});

const stars = new THREE.Points(starGeometry, starMaterial);
scene.add(stars);

// Floor
const textureLoader = new THREE.TextureLoader();
const floorTexture = textureLoader.load('garage_floor.jpg');
floorTexture.wrapS = THREE.RepeatWrapping;
floorTexture.wrapT = THREE.RepeatWrapping;
floorTexture.repeat.set(4, 4);

// Luxury reflective floor
const floorMaterial = new THREE.MeshStandardMaterial({ 
    map: floorTexture,
    metalness: 0.3,
    roughness: 0.1,
    envMapIntensity: 0.5
});
const floor = new THREE.Mesh(new THREE.PlaneGeometry(20, 20), floorMaterial);
floor.rotation.x = -Math.PI / 2;
floor.receiveShadow = true;
scene.add(floor);

// Add subtle luxury ambient elements
const luxuryRingGeometry = new THREE.TorusGeometry(8, 0.1, 16, 100);
const luxuryRingMaterial = new THREE.MeshBasicMaterial({
    color: 0xffd700,
    transparent: true,
    opacity: 0.3,
    blending: THREE.AdditiveBlending
});
const luxuryRing = new THREE.Mesh(luxuryRingGeometry, luxuryRingMaterial);
luxuryRing.rotation.x = -Math.PI / 2;
luxuryRing.position.y = 0.05;
scene.add(luxuryRing);

// Load Car
let car = null; // Variable to store car reference
const loader = new GLTFLoader();
loader.load('mclaren_senna__www.vecarz.com.glb', function (gltf) {
    car = gltf.scene;
    car.traverse(function (child) {
        if (child.isMesh) {
            child.castShadow = true;
            child.receiveShadow = true;
        }
    });

    // Enhanced luxury car material setup - preserving original colors
    car.traverse((child) => {
        if (child.isMesh && child.material) {
            // Store original color before modifications
            const originalColor = child.material.color ? child.material.color.clone() : new THREE.Color(1, 1, 1);
            
            // Create luxury car paint material
            if (child.material.name && child.material.name.toLowerCase().includes('paint')) {
                child.material.metalness = 0.9;
                child.material.roughness = 0.1;
                // Keep original paint color instead of forcing black
                child.material.envMapIntensity = 2;
            } 
            // Chrome/metal parts
            else if (child.material.name && (child.material.name.toLowerCase().includes('chrome') || 
                     child.material.name.toLowerCase().includes('metal'))) {
                child.material.metalness = 1.0;
                child.material.roughness = 0.05;
                // Keep original chrome/metal color
            }
            // Body/car parts - enhance but keep original colors
            else if (child.material.name && (child.material.name.toLowerCase().includes('body') ||
                     child.material.name.toLowerCase().includes('car') ||
                     child.material.name.toLowerCase().includes('exterior'))) {
                child.material.metalness = 0.8;
                child.material.roughness = 0.2;
                // Keep original body color
            }
            // Default luxury settings for other parts
            else {
                child.material.metalness = 0.6;
                child.material.roughness = 0.4;
                // Keep original color for all other parts
            }
            
            // Enhanced reflections for luxury look while preserving colors
            child.material.envMapIntensity = 1.5;
        }
    });

    // Auto-fit camera to model size
    const box = new THREE.Box3().setFromObject(car);
    const size = box.getSize(new THREE.Vector3());
    const center = box.getCenter(new THREE.Vector3());
    
    // Calculate the maximum dimension
    const maxDim = Math.max(size.x, size.y, size.z);
    
    // Camera transition setup
    const startDistance = maxDim * 4; // Start far away
    const endDistance = maxDim * 0.6;   // End much closer to car
    const transitionDuration = 3000; // 4 seconds transition for more dramatic effect
    const startTime = Date.now();
    
    // Starting position (far away)
    camera.position.set(startDistance, startDistance * 0.5, startDistance);
    camera.lookAt(center);
    
    // Camera transition variables
    let cameraTransition = {
        isAnimating: true,
        startPos: camera.position.clone(),
        endPos: new THREE.Vector3(endDistance, endDistance * 0.5, endDistance),
        startTime: startTime,
        duration: transitionDuration
    };
    
    
    // Scale model if needed (optional, remove if model size is correct)
    if (maxDim > 10 || maxDim < 0.1) {
        const scaleFactor = 2 / maxDim; // Scale to approximately 2 units
        car.scale.setScalar(scaleFactor);
    }
    
    scene.add(car);
    
    console.log('Model size:', size);
    console.log('Model center:', center);
    console.log('Max dimension:', maxDim);

    // Render loop
    function animate(time) {
        requestAnimationFrame(animate);
        
        // Camera transition animation
        if (cameraTransition.isAnimating) {
            const elapsed = Date.now() - cameraTransition.startTime;
            const progress = Math.min(elapsed / cameraTransition.duration, 1);
            
            // Smooth easing function (ease-out cubic)
            const easedProgress = 1 - Math.pow(1 - progress, 3);
            
            // Interpolate camera position
            camera.position.lerpVectors(cameraTransition.startPos, cameraTransition.endPos, easedProgress);
            camera.lookAt(center);
            
            // Stop animation when complete
            if (progress >= 1) {
                cameraTransition.isAnimating = false;
                console.log('Camera transition complete');
            }
        }
        
        // Update flashlight position and direction to follow camera
        flashlight.position.copy(camera.position);
        flashlight.target.position.copy(camera.getWorldDirection(new THREE.Vector3()).add(camera.position));
        
        // Animate luxury lighting for dramatic effect
        const lightTime = time * 0.001;
        
        // Ultra bright main spotlights intensity animation
        mainSpotlight1.intensity = 8 + Math.sin(lightTime * 1.5) * 1.2;
        mainSpotlight2.intensity = 7.5 + Math.cos(lightTime * 1.2) * 1.0;
        
        // Maximum brightness front spotlights animation
        frontSpotlight1.intensity = 6.5 + Math.sin(lightTime * 1.8) * 1.0;
        frontSpotlight2.intensity = 6.5 + Math.cos(lightTime * 2.1) * 1.0;
        
        // Super bright top spotlight animation
        topSpotlight.intensity = 7 + Math.sin(lightTime * 1.3) * 1.2;
        
        // Rim lights pulsing effect
        rimLight1.intensity = 2 + Math.sin(lightTime * 2.5) * 0.3;
        rimLight2.intensity = 2 + Math.cos(lightTime * 2.8) * 0.3;
        
        // Accent light breathing effect
        accentLight.intensity = 1.5 + Math.sin(lightTime * 0.8) * 0.2;
        
        // Subtle light movement for cinematic effect
        mainSpotlight1.position.x = -6 + Math.sin(lightTime * 0.3) * 0.5;
        mainSpotlight2.position.x = 6 + Math.cos(lightTime * 0.4) * 0.5;
        
        // Removed volumetric and particle animations for cleaner performance
        
        // Animate car rotation slightly for showcase effect
        if (car) {
            car.rotation.y = Math.sin(lightTime * 0.2) * 0.1;
        }
        
        // Animate luxury ring
        luxuryRing.rotation.z = lightTime * 0.1;
        luxuryRing.material.opacity = 0.2 + Math.sin(lightTime * 1.8) * 0.1;
        
        // Animate stars (twinkling effect)
        stars.rotation.x = lightTime * 0.02;
        stars.rotation.y = lightTime * 0.01;
        starMaterial.opacity = 0.6 + Math.sin(lightTime * 2) * 0.3;
        
        // Dynamic fog intensity
        scene.fog.density = 0.01 + Math.sin(lightTime) * 0.005;
        
        composer.render();
    }
    animate(0);
});

// Responsive
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
    composer.setSize(window.innerWidth, window.innerHeight);
});

// Tambahkan kontrol keyboard untuk toggle flashlight
let flashlightEnabled = true;
document.addEventListener('keydown', (event) => {
    if (event.code === 'KeyF') {
        flashlightEnabled = !flashlightEnabled;
        flashlight.visible = flashlightEnabled;
    }
});