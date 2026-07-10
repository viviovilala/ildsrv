from fastapi import FastAPI, File, UploadFile
from pydantic import BaseModel


app = FastAPI(
    title="JDIH UPNVJT AI Service",
    description="Starter API for semantic search, summarization, RAG, OCR, and recommendation.",
    version="0.1.0",
)


class TextRequest(BaseModel):
    text: str


class SearchRequest(BaseModel):
    query: str
    limit: int = 10


@app.get("/health")
def health_check():
    return {"status": "ok", "service": "jdih-upnvjt-ai"}


@app.post("/api/ai/search")
def semantic_search(payload: SearchRequest):
    return {
        "query": payload.query,
        "limit": payload.limit,
        "results": [],
        "status": "placeholder",
    }


@app.post("/api/ai/summary")
def summarize_document(payload: TextRequest):
    return {
        "summary": "",
        "status": "placeholder",
        "input_length": len(payload.text),
    }


@app.post("/api/ai/chat")
def rag_chat(payload: TextRequest):
    return {
        "answer": "",
        "sources": [],
        "status": "placeholder",
        "question": payload.text,
    }


@app.post("/api/ai/ocr")
async def ocr_document(file: UploadFile = File(...)):
    return {
        "filename": file.filename,
        "text": "",
        "status": "placeholder",
    }


@app.get("/api/ai/recommendation")
def recommend_documents(document_id: int | None = None, limit: int = 5):
    return {
        "document_id": document_id,
        "limit": limit,
        "results": [],
        "status": "placeholder",
    }
