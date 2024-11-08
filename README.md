# Ionic 5 Project Setup Guide

## Prerequisites Installation

### 1. Install NVM (Node Version Manager)

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
source ~/.bashrc  # Activate NVM

# Verify installation
nvm --version
```

### 2. Install Node.js via NVM

```sh
nvm install 14.15.0
nvm use 14.15.0

# Verify installation
node --version
npm --version
```

### 3. Install Java Development Kit 8

```sh
sudo apt update
sudo apt install openjdk-8-jdk

# Set JAVA_HOME
echo 'export JAVA_HOME=/usr/lib/jvm/java-8-openjdk-amd64' >> ~/.bashrc
echo 'export PATH=$PATH:$JAVA_HOME/bin' >> ~/.bashrc
source ~/.bashrc

# Verify installation
java -version
javac -version
```

### 4.  Install Android Studio & SDK

1. Download Android Studio from [official site](https://developer.android.com/studio)
2. Extract and install:

    ```sh
    sudo tar -xzf android-studio-*.tar.gz -C /opt
    cd /opt/android-studio/bin
    ./studio.sh
    ```

3. During setup, ensure you install:

    - Android SDK
    - Android SDK Platform
    - Android Virtual Device

4. Set Android environment variables:

    ```sh
    echo 'export ANDROID_HOME=$HOME/Android/Sdk' >> ~/.bashrc
    echo 'export PATH=$PATH:$ANDROID_HOME/tools' >> ~/.bashrc
    echo 'export PATH=$PATH:$ANDROID_HOME/tools/bin' >> ~/.bashrc
    echo 'export PATH=$PATH:$ANDROID_HOME/platform-tools' >> ~/.bashrc
    source ~/.bashrc
    ```

### 5. Install Ionic CLI & Cordova

```sh
#npm install -g ionic
npm install -g @ionic/cli@5.4.16
npm install -g cordova@11.0.0

# Verify installations
ionic --version
cordova --version
```

## Project Setup

### 1. Clone & Install Dependencies

```sh
# Clone repository
git clone [repository-url]
cd [project-name]

# Install dependencies
npm install
```

### 2. Platform Setup

```sh
# Add platforms
ionic cordova platform add android
ionic cordova platform add browser

# Check requirements
ionic info
cordova requirements
```

### 2. Development Commands

```sh
# Serve in browser
ionic serve

# Run on Android
ionic cordova run android

# Live reload on Android
ionic cordova run android -l

# Build for production
ionic cordova build android --prod
```

## Troubleshooting

### Common Issues & Solutions

1. **Gradle Error**

    - Verify JAVA_HOME points to JDK 8
    - Run: `echo $JAVA_HOME` to confirm

2. **Android SDK Issues**

    - Verify ANDROID_SDK_ROOT: `echo $ANDROID_SDK_ROOT`
    - Check platform-tools: `adb --version`

3. **Node Version Conflicts**

    - Use correct Node version: `nvm use 14.15.0`
    - Clear npm cache: `npm cache clean --force`

### Environment Verification

```sh
# Check all environment variables
echo $JAVA_HOME
echo $ANDROID_ROOT
echo $PATH

# Verify tools
adb devices
gradle -v
```

## Project Structure

```console
├── src/                  # Application source code
├── www/                  # Built application
├── resources/           # Platform resources (icons, splash screens)
├── config.xml           # Cordova configuration
└── package.json         # Project dependencies
```
