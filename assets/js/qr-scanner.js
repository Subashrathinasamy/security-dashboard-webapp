// qr-scanner.js

class QRScanner {
  constructor(qrReaderId, onSuccess, onFailure, options = {}) {
    this.qrReaderId = qrReaderId;
    this.onSuccess = onSuccess;
    this.onFailure = onFailure;
    this.options = {
      fps: 10,
      qrbox: 250,
      ...options
    };
    this.scanner = null;
  }

  start() {
    if (this.scanner) {
      this.scanner.clear();
      this.scanner = null;
    }

    this.scanner = new Html5QrcodeScanner(
      this.qrReaderId,
      { fps: this.options.fps, qrbox: this.options.qrbox },
      false
    );

    this.scanner.render(
      (decodedText, decodedResult) => {
        if (typeof this.onSuccess === "function") {
          this.onSuccess(decodedText, decodedResult);
        }
      },
      (errorMessage) => {
        if (typeof this.onFailure === "function") {
          this.onFailure(errorMessage);
        }
      }
    );
  }

  stop() {
    if (this.scanner) {
      this.scanner.clear().catch(err => console.error('Failed to clear QR scanner', err));
      this.scanner = null;
    }
  }
}
