# ILDIS AI Service Starter

Starter service ini disiapkan sebagai fondasi terpisah untuk fitur AI-powered JDIH UPNVJT. Service ini belum dihubungkan ke aplikasi Yii2 production.

## Stack Rencana

- FastAPI
- Sentence Transformers
- BGE-M3 embeddings
- Qdrant vector database
- PaddleOCR untuk OCR dokumen

## Endpoint Roadmap

- `POST /api/ai/search` untuk semantic search dokumen
- `POST /api/ai/summary` untuk ringkasan peraturan
- `POST /api/ai/chat` untuk RAG chatbot
- `POST /api/ai/ocr` untuk scan PDF
- `GET /api/ai/recommendation` untuk rekomendasi dokumen terkait

## Menjalankan Lokal

```bash
pip install -r requirements.txt
uvicorn app.main:app --reload --host 0.0.0.0 --port 8010
```

Semua endpoint masih placeholder agar integrasi bisa dilakukan bertahap dan aman.
