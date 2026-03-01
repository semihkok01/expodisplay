import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { RoundedBoxGeometry } from 'three/examples/jsm/geometries/RoundedBoxGeometry.js';

const createDeviceViewer = (root) => {
    const canvas = root.querySelector('[data-device-canvas]');

    if (!canvas) {
        return () => {};
    }

    const renderer = new THREE.WebGLRenderer({
        canvas,
        antialias: true,
        alpha: false,
        powerPreference: 'high-performance',
    });

    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0x0f1730);

    const camera = new THREE.PerspectiveCamera(34, 1, 0.1, 40);
    camera.position.set(4.8, 3.1, 6.4);

    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.06;
    controls.enablePan = false;
    controls.minDistance = 4.2;
    controls.maxDistance = 10.5;
    controls.rotateSpeed = 0.8;
    controls.zoomSpeed = 0.9;
    controls.target.set(0, 2.1, 0);
    controls.update();

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.45);
    scene.add(ambientLight);

    const keyLight = new THREE.DirectionalLight(0xffffff, 1.15);
    keyLight.position.set(6, 8, 7);
    keyLight.castShadow = true;
    keyLight.shadow.mapSize.set(1024, 1024);
    keyLight.shadow.radius = 3;
    keyLight.shadow.blurSamples = 6;
    scene.add(keyLight);

    const fillLight = new THREE.DirectionalLight(0x86a8ff, 0.65);
    fillLight.position.set(-7, 4, 5);
    scene.add(fillLight);

    const rimLight = new THREE.DirectionalLight(0xf472b6, 0.5);
    rimLight.position.set(3, 5, -6);
    scene.add(rimLight);

    const stage = new THREE.Group();
    scene.add(stage);

    const height = 6.425;
    const width = 3.8;
    const depth = 2.5;
    const radius = 0.18;
    const segments = 8;

    const bodyGeometry = new RoundedBoxGeometry(width, height, depth, segments, radius);
    const bodyMaterial = new THREE.MeshStandardMaterial({
        color: 0x0b1226,
        metalness: 0.22,
        roughness: 0.3,
    });
    const body = new THREE.Mesh(bodyGeometry, bodyMaterial);
    body.castShadow = true;
    body.receiveShadow = true;
    body.position.y = height / 2;
    stage.add(body);

    const panelGeometry = new RoundedBoxGeometry(width - 0.46, height - 0.54, 0.18, segments, 0.16);
    const panelMaterial = new THREE.MeshStandardMaterial({
        color: 0xf4f7ff,
        metalness: 0.06,
        roughness: 0.22,
    });
    const panel = new THREE.Mesh(panelGeometry, panelMaterial);
    panel.position.set(0, height / 2, depth / 2 - 0.06);
    panel.castShadow = true;
    stage.add(panel);

    const screenGeometry = new RoundedBoxGeometry(width - 1.08, height - 2.1, 0.08, segments, 0.12);
    const screenMaterial = new THREE.MeshStandardMaterial({
        color: 0x070b14,
        metalness: 0.35,
        roughness: 0.18,
    });
    const screen = new THREE.Mesh(screenGeometry, screenMaterial);
    screen.position.set(0, height / 2 - 0.22, depth / 2 + 0.06);
    stage.add(screen);

    const reflectionGeometry = new THREE.PlaneGeometry(width - 1.36, height - 2.4);
    const reflectionMaterial = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        transparent: true,
        opacity: 0.08,
        metalness: 0.1,
        roughness: 0.12,
        side: THREE.DoubleSide,
    });
    const reflection = new THREE.Mesh(reflectionGeometry, reflectionMaterial);
    reflection.position.set(-0.12, height / 2 + 0.08, depth / 2 + 0.12);
    reflection.rotation.y = -0.12;
    stage.add(reflection);

    const sensorGeometry = new RoundedBoxGeometry(0.9, 0.18, 0.12, segments, 0.08);
    const sensorMaterial = new THREE.MeshStandardMaterial({
        color: 0x141b29,
        metalness: 0.22,
        roughness: 0.28,
    });
    const sensor = new THREE.Mesh(sensorGeometry, sensorMaterial);
    sensor.position.set(0, height - 0.9, depth / 2 + 0.1);
    stage.add(sensor);

    const lensGeometry = new THREE.SphereGeometry(0.06, 16, 16);
    const lensMaterial = new THREE.MeshStandardMaterial({
        color: 0x284778,
        emissive: 0x1d4ed8,
        emissiveIntensity: 0.18,
        metalness: 0.4,
        roughness: 0.15,
    });
    const lens = new THREE.Mesh(lensGeometry, lensMaterial);
    lens.position.set(-0.24, height - 0.9, depth / 2 + 0.18);
    stage.add(lens);

    const baseGeometry = new THREE.CylinderGeometry(2.6, 3.1, 0.12, 48);
    const baseMaterial = new THREE.MeshStandardMaterial({
        color: 0x0b1226,
        transparent: true,
        opacity: 0.55,
        roughness: 0.9,
        metalness: 0,
    });
    const base = new THREE.Mesh(baseGeometry, baseMaterial);
    base.position.set(0, -0.06, 0);
    base.receiveShadow = true;
    stage.add(base);

    const floorGeometry = new THREE.PlaneGeometry(16, 16);
    const floorMaterial = new THREE.ShadowMaterial({
        color: 0x000000,
        opacity: 0.16,
    });
    const floor = new THREE.Mesh(floorGeometry, floorMaterial);
    floor.rotation.x = -Math.PI / 2;
    floor.position.y = -0.12;
    floor.receiveShadow = true;
    scene.add(floor);

    let frameId = 0;
    let lastInteraction = performance.now();
    let isInteracting = false;

    controls.addEventListener('start', () => {
        isInteracting = true;
        lastInteraction = performance.now();
    });

    controls.addEventListener('end', () => {
        isInteracting = false;
        lastInteraction = performance.now();
    });

    const resize = () => {
        const widthPx = Math.max(root.clientWidth, 1);
        const heightPx = Math.max(root.clientHeight, 1);
        camera.aspect = widthPx / heightPx;
        camera.updateProjectionMatrix();
        renderer.setSize(widthPx, heightPx, false);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    };

    const resizeObserver = new ResizeObserver(() => resize());
    resizeObserver.observe(root);
    resize();

    const animate = (time) => {
        frameId = window.requestAnimationFrame(animate);

        if (!isInteracting && time - lastInteraction > 3000) {
            stage.rotation.y += 0.0022;
        }

        controls.update();
        renderer.render(scene, camera);
    };

    animate(performance.now());

    const cleanup = () => {
        window.cancelAnimationFrame(frameId);
        resizeObserver.disconnect();
        controls.dispose();

        stage.traverse((child) => {
            if ('geometry' in child && child.geometry) {
                child.geometry.dispose();
            }

            if ('material' in child && child.material) {
                const material = Array.isArray(child.material) ? child.material : [child.material];
                material.forEach((entry) => entry.dispose());
            }
        });

        floorGeometry.dispose();
        floorMaterial.dispose();
        renderer.dispose();
    };

    return cleanup;
};

export const initDeviceViewer = () => {
    const roots = Array.from(document.querySelectorAll('[data-device-viewer]'));

    if (!roots.length) {
        return;
    }

    const cleanups = roots.map((root) => createDeviceViewer(root));

    window.addEventListener('pagehide', () => {
        cleanups.forEach((cleanup) => cleanup());
    }, { once: true });
};
